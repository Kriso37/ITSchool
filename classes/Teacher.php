<?php 


require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
require_once ("base.php");

class Teacher extends Base 
{
    public $name,$expyear,$realname,$photo;

    public function Create($name,$realname,$expyear,$photo)
    {
        
        parent::__construct();
        $name = $this->sql->real_escape_string($name);
        $expyear = $this->sql->real_escape_string($expyear);
        $realname = $this->sql->real_escape_string($realname);
        $photo = $this->sql->real_escape_string($photo);
        $result = $this->sql->query("SELECT * FROM users WHERE name = '$name'");
        if($result->num_rows>0)
        {
            $result = $this->sql->query("SELECT * FROM teachers WHERE name = '$name'");
            if($result->num_rows>0)
            {
                dieNew("Taj korisnik je vec mentor, obrisite ga.");
            }
            else 
            {
                $this->name = $name;
                $this->expyear = $expyear;
                $this->realname = $realname;
                $this->photo = $photo;

                $this->sql->query("UPDATE users SET teacher = 1 WHERE name = '$name' LIMIT 1");

                $this->sql->query("INSERT INTO teachers (name,realname,expyear,photo) VALUES ('$name','$realname','$expyear','$photo')");
            }
        }
        else 
        {
            dieNew("Ne postoji korisnik sa tim imenom");
        }
    }
    public function Remove($name)
    {
        
        parent::__construct();

        $result = $this->sql->query("SELECT * FROM users WHERE name = '$name' LIMIT 1");
        if($result->num_rows>0)
        {
            $result = $this->sql->query("SELECT * FROM teachers WHERE name = '$name'");
            if($result->num_rows>0)
            {
                $this->sql->query("DELETE FROM teachers WHERE name = '$name'");
                $this->sql->query("UPDATE users SET teacher = 0 WHERE name = '$name' ");
                $this->sql->query("DELETE FROM lectures WHERE nameteacher = '$name'");
                header("Location: ../index.php");
            }
            else 
            {
                dieNew("Taj korisnik nije mentor.");
            }
        }
        else 
        {
            dieNew("Ne postoji mentor sa tim imenom");
        }
    }
    public function getAllTeachers()
    {
        parent::__construct();
        $result = $this->sql->query("SELECT * FROM teachers");
        if($result->num_rows>0)
        {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
}