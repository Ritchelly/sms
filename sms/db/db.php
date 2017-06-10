<?php

class DB extends PDO
{


    private $dsn = 'mysql:host=localhost;dbname=sms';
    private $user = 'gv';
    private $password = 'gv';
    public $handle = null;

    function __construct( ) {
        try {
            if ( $this->handle == null ) {
                $dbh = parent::__construct( $this->dsn , $this->user , $this->password );
                $this->handle = $dbh;
                return $this->handle;
            }
        }
        catch ( PDOException $e ) {
            echo 'Connection failed: ' . $e->getMessage( );
            return false;
        }
    }

    function __destruct( ) {
        $this->handle = NULL;
    }


}

?>