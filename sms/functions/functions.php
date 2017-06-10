<?php

include_once('/var/www/html/sms/db/db.php');
include('/var/www/html/sms/ami/amiclass.php');
include('../phpexcel/import.php');
require_once('../phpexcel/classes/PHPExcel.php');


if(isset($_GET['send_sms']))
{
    $message=$_POST['msg'];
    $device='dongle0';

    $db= new DB();
    $query="select client_id,phone_number,client_name from sms_list where send_status = 0 limit 1";

    $rs=$db->query($query);

    $qtd_rows=$rs->rowCount();

    if($qtd_rows>0)
    {

        $rs=$rs->fetch(PDO::FETCH_ASSOC);

        $client_id=$rs['client_id'];
        $client_name=$rs['client_name'];
        $phone_number=$rs['phone_number'];


        $message=str_replace('[nome]',$client_name,$message);
        $message=str_replace('[protocolo]',$client_id,$message);

        $sms=new Dongle();
        $return_sms_full= $sms->SendSMS($device,'+55'.$phone_number,$message);

        ($return_sms_full[6]=='response:success'?$ami_response=1:$ami_response=2);
         $return_action_id=explode(':',$return_sms_full[7]);
         $return_log=$return_sms_full[8];
         $return_send_id=explode(':',$return_sms_full[9]);

         $return_sms_refact=[
            'response'=>$ami_response,
            'action_id'=>@$return_action_id[1],
            'log'=>$return_log,
            'send_id'=>@$return_send_id[1]
         ];

        $query="
        update
          sms_list
        set
            send_status={$return_sms_refact['response']},
            action_id='{$return_sms_refact['action_id']}',
            send_id='{$return_sms_refact['send_id']}',
            log = '{$return_sms_refact['log']}',
            dongle='{$device}'
        where
            client_id= :client_id";

        $stmt=$db->prepare($query);
        $stmt->bindParam(':client_id',$client_id);

       $stmt->execute() ;

        echo($query).'<br>';

        echo('<pre>');
        print_r($return_sms_refact);
    }
    else
    {
        // status sem mailing
        echo 3;
    }
}

if(isset($_GET['get_statistics']))
{
    DB_Statistics();
}

if(isset($_GET['import_file']))
{
     $file=$_POST['file'];

    //$file='teste.xlsx';
    ImportFile($file);
}
if(isset($_GET['delete_db']))
{
    $db= new DB();
    $query="delete  from sms_list";
    $rs=$db->exec($query);
    echo $rs;
}

//--------------------------------------------------------------------------------------------------------------------//

function DB_Statistics()
{

    $db= new DB();
    $query="select count(*)total,sum(send_status=1)sent,sum(send_status=0)no_sent,sum(send_status=2)sent_error from sms_list";

    $rs=$db->query($query);
    $rs=$rs->fetch(PDO::FETCH_ASSOC);

    $qtd_total=$rs['total'];
    $sent=$rs['sent'];
    $no_sent=$rs['no_sent'];
    $sent_error=$rs['sent_error'];


    $return=['total'=>$qtd_total,'sent'=>$sent,'no_sent'=>$no_sent,'sent_error'=>$sent_error];

    echo json_encode($return);

}

//--------------------------------------------------------------------------------------------------------------------//

function ImportFile($file)
{
    $import = new ImportXLSX();
    $import->Import($file);
}


?>
