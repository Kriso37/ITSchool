<?php 

require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
require_once ("base.php");
require_once ("Session.php");
class Users extends Base
{
    public $name,$password,$email;

    public function Login($email,$password)
    {
        parent::__construct();

        $email = $this->sql->real_escape_string($email);
        $password = $this->sql->real_escape_string($password);
        $result = $this->sql->query("SELECT * FROM users WHERE email = '$email'");
        if($result->num_rows>0) 
        {
            $user = $result->fetch_assoc();
            if(password_verify($password,$user['password']) == true)
            {
                new Session();
                $this->email = $email;
                $this->password = $password;
                $this->name = $_SESSION['name'] = $user['name'];
                $_SESSION['loggined'] = true;
                $_SESSION['money'] = $user['money'];
                $_SESSION['email'] = $email;
                if($user['admin'] == 1)
                {
                    $_SESSION['admin'] = 1;
                }
                if($user['teacher'] == 1)
                {
                    $_SESSION['teacher'] = 1;
                }
                $_SESSION['paid'] = $user['paid'];
                header("Location: ../index.php");
            }
            else 
            {
                dieNew("Netacan email ili sifra.");
            }
        }
        else 
        {
            dieNew("Netacan email ili sifra.");
        }
    }
    public function buy($type,$price)
    {
        $type = $this->sql->real_escape_string($type);
        $price = $this->sql->real_escape_string($price);
        $name = $_SESSION['name'];
        $name = $this->sql->real_escape_string($name);
        $result = $this->sql->query("SELECT * FROM users WHERE name = '$name'");
        if($result->num_rows>0) 
        {
            $_SESSION['paid'] = $type;
            $_SESSION['money'] -= $price;
            $paid = $_SESSION['paid'];
            $money = $_SESSION['money'];
            $this->sql->query("UPDATE users SET paid = $paid,money = $money WHERE name = '$name'");
            $_SESSION['successbuy'] = true;
            header("Location: ../index.php");
            
        }
        else 
        {
            dieNew("Greska, prijavite se ponovo.");
        }

    }
    public function Register($email,$password,$name)
    {
        parent::__construct();

        $email = $this->sql->real_escape_string($email);
        $password = $this->sql->real_escape_string($password);
        $name = $this->sql->real_escape_string($name);
        $result = $this->sql->query("SELECT * FROM users WHERE email = '$email' OR name = '$name'");
        if($result->num_rows>0) 
        {
            dieNew("Taj email ili ime su vec zauzeti.");
        }
        else 
        {
            new Session();
            $password = password_hash($password,  PASSWORD_BCRYPT);
            $this->sql->query("INSERT INTO users (name,password,email) VALUES ('$name','$password','$email')");
            header("Location: ../index.php");
            $_SESSION['loggined'] = true;
            $_SESSION['name'] = $user['name'];
            $_SESSION['money'] = 0;
            $_SESSION['email'] = $email;
            prikazi_popup("Uspesna registracija");
        }
    }
    public function GetAllUsers()
    {
        parent::__construct();

        $result = $this->sql->query("SELECT * FROM users");
        if($result->num_rows>0) 
        {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        else 
        {
            dieNew("Nema korisnika.");
        }

    }
}