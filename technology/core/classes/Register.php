<?php

class Register extends Database
{
    private $st_id;
    private $st_no;
    private $st_name;
    private $pay;
   
    private $class_id;
    private $sch_id;
    private $level_id;
    private $user_id;
    private $reg_date;
    

    public function ViewClass(){
        $this->query("SELECT * FROM `tb_class` WHERE level_id =:level_id");
        $this->bind('level_id', $this->level_id);
        return $this->resultset();
    }
    

    public function viewFee(){
        $this->query("SELECT * FROM `tb_school_fee` WHERE level_id =:level_id AND sch_id =:sch_id");
        $this->bind('level_id', $this->level_id);
        $this->bind('sch_id', $this->sch_id);
        return $this->single();
    }

    public function getCheck()
    {
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_register` WHERE sch_id =:sch_id AND st_id=:st_id");
        $this->bind('sch_id', $this->sch_id);
        $this->bind('st_id', $this->st_id);
        return $this->single();
    }

    public function getCheckLevel()
    {
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_register` WHERE level_id =:level_id AND st_id=:st_id");
        $this->bind('level_id', $this->level_id);
        $this->bind('st_id', $this->st_id);
        return $this->single();
    }


    public function getSch(){
        $this->query("SELECT * FROM `tb_sch_year`");
        return $this->resultset();
    }

    public function getReportRegister(){
        // $this->query("SELECT * FROM `tb_register` INNER JOIN `tb_student` ON tb_register.st_id = tb_student.st_id INNER JOIN tb_class ON tb_register.class_id = tb_class.class_id INNER JOIN tb_sch_year ON tb_register.sch_id = tb_sch_year.sch_id INNER JOIN tb_user ON tb_register.user_id = tb_user.user_id INNER JOIN tb_teacher ON tb_user.teach_id = tb_teacher.teach_id WHERE tb_register.st_id=:st_id AND tb_register.sch_id=:sch_id");
        $this->query("SELECT * FROM `tb_register`INNER JOIN tb_student ON tb_register.st_id = tb_student.st_id INNER JOIN tb_class ON tb_student.class_id = tb_class.class_id INNER JOIN tb_sch_year ON tb_register.sch_id = tb_sch_year.sch_id INNER JOIN tb_user ON tb_register.user_id = tb_user.user_id INNER JOIN tb_teacher ON tb_user.teach_id = tb_teacher.teach_id WHERE tb_register.st_id=:st_id AND tb_register.sch_id=:sch_id");
        $this->bind('st_id', $this->st_id);
        $this->bind('sch_id', $this->sch_id);
        return $this->resultset();
    }

    public function getViewRecipeReport(){
        $this->query("SELECT SUM(pay) AS price,level_name,COUNT(st_id) AS student,pay FROM `tb_register` INNER JOIN tb_class_level ON tb_register.level_id=tb_class_level.level_id WHERE sch_id=:sch_id GROUP BY tb_register.level_id");
        // $this->query("SELECT * FROM `tb_register` WHERE sch_id=:sch_id");
        $this->bind('sch_id', $this->sch_id);
        return $this->resultset();
    }

    public function getViewRecipePrint(){
        // $this->query("SELECT * FROM `tb_register` INNER JOIN `tb_student` ON tb_register.st_id = tb_student.st_id INNER JOIN tb_class ON tb_register.class_id = tb_class.class_id INNER JOIN tb_sch_year ON tb_register.sch_id = tb_sch_year.sch_id INNER JOIN tb_user ON tb_register.user_id = tb_user.user_id INNER JOIN tb_teacher ON tb_user.teach_id = tb_teacher.teach_id WHERE tb_register.st_id=:st_id AND tb_register.sch_id=:sch_id");
        // $this->query("SELECT * FROM `tb_register` INNER JOIN tb_sch_year ON tb_register.sch_id = tb_sch_year.sch_id INNER JOIN tb_class_level ON tb_register.level_id = tb_class_level.level_id WHERE tb_register.sch_id=:sch_id");
        $this->query("SELECT SUM(pay) AS price,level_name,COUNT(st_id) AS student,pay,sch_name FROM `tb_register` INNER JOIN tb_sch_year ON tb_register.sch_id = tb_sch_year.sch_id INNER JOIN tb_class_level ON tb_register.level_id=tb_class_level.level_id WHERE tb_register.sch_id=:sch_id GROUP BY tb_register.level_id;");
        $this->bind('sch_id', $this->sch_id);
        return $this->resultset();
    }


    public function ViewStudent(){
        $this->query("SELECT * FROM `tb_student` INNER JOIN `tb_class` ON tb_class.class_id = tb_student.class_id INNER JOIN tb_class_level ON tb_student.level_id = tb_class_level.level_id INNER JOIN tb_sch_year ON tb_student.sch_id = tb_sch_year.sch_id WHERE tb_student.st_no=:st_no");
        $this->bind('st_no', $this->st_no);
        return $this->single();

    }

    public function ViewStudentMove(){
        $this->query("SELECT * FROM `tb_student` INNER JOIN `tb_class` ON tb_class.class_id = tb_student.class_id INNER JOIN tb_class_level ON tb_student.level_id = tb_class_level.level_id INNER JOIN tb_sch_year ON tb_student.sch_id = tb_sch_year.sch_id WHERE tb_student.st_no=:st_no AND st_status = 2");
        $this->bind('st_no', $this->st_no);
        return $this->single();

    }

    public function PrintStudent(){
        $this->query("SELECT * FROM `tb_student` INNER JOIN `tb_class` ON tb_class.class_id = tb_student.class_id WHERE tb_student.st_no=:st_no");
        $this->bind('st_no', $this->st_no);
        return $this->single();

    }

    public function getLevel()
    {
        $this->query("select * from tb_class where level_id=:level_id");
        $this->bind('level_id', $this->level_id);
        return $this->resultset();

    }

    public function AddRegister(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_register` (`st_id`,`level_id`,`class_id`,`sch_id`,`user_id`,`pay`,`reg_date`) VALUES (:st_id,:level_id,:class_id,:sch_id,:user_id,:pay,:reg_date)");
            $this->bind('st_id', $this->st_id);
            $this->bind('level_id', $this->level_id);
            $this->bind('class_id', $this->class_id);
            $this->bind('sch_id', $this->sch_id);
            $this->bind('user_id', $this->user_id);
            $this->bind('pay', $this->pay);
            $this->bind('user_id', $this->user_id);
            $this->bind('reg_date', $this->reg_date);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function AddMoveStudent(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_student` SET `class_id`=:class_id WHERE `st_id`=:st_id");
            $this->bind('st_id', $this->st_id);
            $this->bind('class_id', $this->class_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }


    public function getCheckMoveStudent()
    {
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_student` WHERE class_id =:class_id AND st_id=:st_id");
        $this->bind('class_id', $this->class_id);
        $this->bind('st_id', $this->st_id);
        return $this->single();
    }



    public function UpdateClass(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_student` SET `class_id`=:class_id,`st_status`= 2 WHERE `st_id`=:st_id");
            $this->bind('st_id', $this->st_id);
            $this->bind('class_id', $this->class_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;

    }

    public function SetStudentNo($st_no){
        return $this->st_no = $st_no;
    }

    public function SetStudentId($st_id){
        return $this->st_id = $st_id;
    }

    public function SetLevelId($level_id){
        return $this->level_id = $level_id;
    }

    public function SetClassId($class_id){
        return $this->class_id = $class_id;
    }

    public function SetSchId($sch_id){
        return $this->sch_id = $sch_id;
    }

    public function SetUserId($user_id){
        return $this->user_id = $user_id;
    }

    public function SetRegDate($reg_date){
        return $this->reg_date = $reg_date;
    }

    public function SetPay($pay){
        return $this->pay = $pay;
    }



}