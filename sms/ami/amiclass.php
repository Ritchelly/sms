<?php

class AMI {


    public function ConectaAmi()
    {
        (!isSet($_SESSION)?session_start():'');

        $server='localhost';
        $username='reqvirtual';
        $secret='reqvirtual';
        $port= '5038';

        $this->socket=@fsockopen($server,$port , $errno, $errstr, 1);

        if(($errno!=0) || ($errstr!="") )
        {
            echo  'Erro codigo : '.$errno .'<br>'. $errstr ;
            return '0';
        }
        else
        {
            fputs($this->socket, "Action: Login\r\n");
            fputs($this->socket, "UserName:$username\r\n");
            fputs($this->socket, "Secret: $secret\r\n\r\n");
            return '1';
        }
    }
}

class Dongle extends AMI
{

    function SendSMS($device,$number,$message)
    {
	
 	if($this->ConectaAmi())
        {
            fputs($this->socket, "Action: DongleSendSMS\r\n");
            fputs($this->socket, "Device: $device\r\n");
            fputs($this->socket, "Number: $number\r\n");
            fputs($this->socket, "ActionID: 1\r\n");

            fputs($this->socket, "Message: $message\r\n\r\n");
            fputs($this->socket, "Action: Logoff\r\n\r\n");

            $i = 0;
            while (!feof($this->socket)) 
	   {
                $rs[$i] = str_replace(' ','', strtolower(trim(fgets($this->socket, 128))));
                ($rs[$i]?$wrets[]=$rs[$i]:'');
                $i++;
            }
            return $wrets;
        }	
	
    }





}
?>
