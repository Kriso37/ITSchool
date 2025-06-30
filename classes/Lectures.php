<?php 
require_once "base.php";
require_once ($_SERVER['DOCUMENT_ROOT']. "/Projekat2/funkcije.php");
class Lectures extends Base
{
    public $name,$video,$number;


    public function Create($nameteacher,$name,$video,$number)
    {
        parent::__construct();
        $name = $this->sql->real_escape_string($name);
        $video = $this->sql->real_escape_string($video);
        $number = $this->sql->real_escape_string($number);
        $this->name = $name;
        $this->video = $video;
        $this->number = $number;

        $this->sql->query("INSERT INTO lectures (nameteacher,name,number,video) VALUES ('$nameteacher','$name',$number,'$video')");
        header("Location: ../index.php");
    }
    public function getLecture($name)
    {
        $name = $this->name = $this->sql->real_escape_string($name);

        $result = $this->sql->query("SELECT * FROM lectures WHERE nameteacher = '$name'");

        if($result->num_rows>0)
        {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        else 
        {
            return dieNew("Greska, nema lekcija.");
        }
    }
    public function getComment($lecture,$nameuser)
    {
        $lecture = $this->sql->real_escape_string($lecture);
        $nameuser = $this->sql->real_escape_string($nameuser);

        $result = $this->sql->query("SELECT * FROM comments WHERE lecture = $lecture AND name = '$nameuser'");
        if($result->num_rows>0)
        {
            return false;
        }
        else 
        {
            return true;
        }
    }
    public function addComment($nameuser,$text,$lecture,$teacher,$lecturename)
    {
        $text = $this->sql->real_escape_string($text);
        $lecture = $this->sql->real_escape_string($lecture);
        $nameuser = $this->sql->real_escape_string($nameuser);
        $lecturename = $this->sql->real_escape_string($lecturename);
        $teacher = $this->sql->real_escape_string($teacher);

        $result = $this->sql->query("INSERT INTO comments (name,lecture,text,lecturename,teacher) VALUES ('$nameuser',$lecture,'$text','$lecturename','$teacher')");

        header("Location: ../moduli/lectures.php?type=$teacher");
    }
    public function removeComment($nameuser,$lecture,$teacher)
    {
        $lecture = $this->sql->real_escape_string($lecture);

        $result = $this->sql->query("DELETE FROM comments WHERE name = '$nameuser' AND lecture = $lecture");

        header("Location: ../moduli/lectures.php?type=$teacher");
    }
    public function getAllComments($nameuser)
    {
        $nameuser = $this->sql->real_escape_string($nameuser);

        $result = $this->sql->query("SELECT * FROM comments WHERE name = '$nameuser'");

        if($result->num_rows>0)
        {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        else 
        {
            dieNew("Niste poslala nijedan komentar.");
        }
    }
    public function getAllCommentsTeacher($nameuser)
    {
        $nameuser = $this->sql->real_escape_string($nameuser);

        $result = $this->sql->query("SELECT * FROM comments WHERE teacher = '$nameuser'");

        if($result->num_rows>0)
        {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        else 
        {
            dieNew("Niste primili nijedan komentar od ucenika.");
        }
    }
    public function teacherRespond($teacher,$nameuser,$text,$lecture)
    {
        $nameuser = $this->sql->real_escape_string($nameuser);
        $teacher = $this->sql->real_escape_string($teacher);
        $text = $this->sql->real_escape_string($text);
        $lecture = $this->sql->real_escape_string($lecture);

        $result = $this->sql->query("UPDATE comments SET respond = '$text' WHERE name = '$nameuser' AND teacher = '$teacher' AND lecture = '$lecture' LIMIT 1");

        header("Location: ../moduli/comments.php");
    }

    public function teacherRespondDel($teacher,$nameuser,$lecture)
    {
        $nameuser = $this->sql->real_escape_string($nameuser);
        $teacher = $this->sql->real_escape_string($teacher);
        $lecture = $this->sql->real_escape_string($lecture);

        $result = $this->sql->query("UPDATE comments SET respond = '' WHERE name = '$nameuser' AND teacher = '$teacher' AND lecture = '$lecture' LIMIT 1");

        header("Location: ../moduli/comments.php");
    }
}