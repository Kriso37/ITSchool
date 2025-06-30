<?php 


class Base 
{
    public $sql;

    const SQL_HOST = "localhost";
    const SQL_USER = "root";
    const SQL_PASSWORD = "";
    const SQL_BASE = "itskola";
    public function __construct(){

        $this->sql = mysqli_connect(self::SQL_HOST,self::SQL_USER,self::SQL_PASSWORD,self::SQL_BASE);
        if ($this->sql -> connect_errno) 
        {
            die ("Mysql ERROR: " . $this->sql->connect_error);
            exit();
        }
    }
}
?>