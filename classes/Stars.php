<?php 

require_once "Lectures.php";

class Star extends Lectures 
{
    public $name,$rate,$id;

    public function CreateStar($nameuser,$star,$lecture,$teacher)
    {
        $nameuser = $this->sql->real_escape_string($nameuser);
        $star = $this->sql->real_escape_string($star);
        $lecture = $this->sql->real_escape_string($lecture);

        $result = $this->sql->query("SELECT * FROM lectures WHERE id = $lecture");

        if($result->num_rows>0)
        {
            $result = $this->sql->query("SELECT * FROM stars WHERE lecture = $lecture AND name = '$nameuser'");
            if($result->num_rows>0)
            {
                $this->sql->query("DELETE FROM stars WHERE lecture = $lecture AND name = '$nameuser'");
            }

            $this->sql->query("INSERT INTO stars (name,lecture,star,teacher) VALUES ('$nameuser',$lecture,$star,'$teacher')");
            $this->name = $nameuser;
            $this->rate = $star;
            $this->id = $lecture;
            $this->teacher = $teacher;
            header("Location: ../moduli/lectures.php?type=$teacher");
        }
        else 
        {
            dieNew("Greska: Nepostojeca vezba");
        }
    }
    public function getStars($lectures,$nameuser,$starGet)
    {
        $lectures = $this->sql->real_escape_string($lectures);
        $nameuser = $this->sql->real_escape_string($nameuser);
        $result = $this->sql->query("SELECT * FROM stars WHERE lecture = $lectures AND name = '$nameuser' LIMIT 1");
        if($result->num_rows>0)
        {
            $star = $result->fetch_assoc();
            if($starGet<= $star['star'])
            {
                return true;
            }
            else 
            {
                return false;
            }
        }
        else 
        {
            return false;
        }
    }
    public function getAverageStar($teacher)
    {   
        $teacher = $this->sql->real_escape_string($teacher);
        $result = $this->sql->query("SELECT * FROM stars WHERE teacher = '$teacher'");
        if($result->num_rows>0)
        {
            $stars = $result->fetch_all(MYSQLI_ASSOC);

            $rate = 0;
            foreach($stars as $star)
            {
                $rate+=$star['star'];
            }
            $averagerate = $rate/count($stars);

            return round($averagerate,2);
        }
    }
}
