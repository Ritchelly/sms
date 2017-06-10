<?php

require_once('../phpexcel/classes/PHPExcel.php');
require_once('../db/db.php');

class ImportXLSX
{
private $import_status;



    function Import($file)
    {
        $obj_reader= new PHPExcel_Reader_Excel2007();
        $obj_reader->setReadDataOnly(true);
        $obj_php_excel =$obj_reader->load("../uploads/".$file);

        $data = $obj_php_excel->getActiveSheet()->toArray(null,false,true,false);
        //$qtd_header= count($total[0]);
        $qtd_rows=count($data);

        $index_phone_col= array_search('fone',array_map('strtolower',$data[0]));
        $index_name_col= array_search('nome',array_map('strtolower',$data[0]));

        set_time_limit(0);

        for($i=1;$i<=$qtd_rows-1;$i++)
        {
            $name=$data[$i][$index_name_col];
            $phone=$data[$i][$index_phone_col];
            $db= new DB();

            $query="insert into  sms_list(client_name, import_date, send_status, phone_number) values(:name,now(),0,:phone)";

            $stmt=$db->prepare($query);
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':phone',$phone);
            $stmt->execute();

            $this->import_status=$i;
        }

        set_time_limit(30);
    }

    /**
     * @return mixed
     */
    public function getImportStatus()
    {
        return $this->import_status;
    }



}

?>