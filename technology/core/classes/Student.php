<?php

class Student extends Database
{
    private $st_id;
    private $st_no;
    private $st_name;
    private $sex;
    private $mobile;
    private $village;
    private $district_id;
    private $province_id;
    private $class_id;
    private $level_id;
    private $sch_id;
    private $birthday;
    private $status;

 

    public function getStudent()
    {
        $this->query("SELECT * FROM `tb_student` INNER JOIN tb_class_level ON tb_student.level_id = tb_class_level.level_id INNER JOIN `tb_class` ON tb_class.class_id = tb_student.class_id INNER JOIN tb_district ON tb_district.dis_id = tb_student.dis_id INNER JOIN tb_province ON tb_district.province_id = tb_province.pro_id");
        return $this->resultset();
    }

    public function ViewStudent(){
        $this->query("SELECT * FROM `tb_student` INNER JOIN `tb_class` ON tb_class.class_id = tb_student.class_id INNER JOIN tb_district ON tb_district.dis_id = tb_student.dis_id INNER JOIN tb_province ON tb_district.province_id = tb_province.pro_id INNER JOIN tb_class_level ON tb_student.level_id = tb_class_level.level_id INNER JOIN tb_sch_year ON tb_student.sch_id = tb_sch_year.sch_id WHERE tb_student.st_id=:st_id");
        $this->bind('st_id', $this->st_id);
        return $this->single();

    }

    public function getViewStudentReport()
    {
        $this->query("SELECT * FROM `tb_register` INNER JOIN `tb_class` ON tb_class.class_id = tb_register.class_id INNER JOIN tb_student ON tb_register.st_id = tb_student.st_id INNER JOIN tb_district ON tb_district.dis_id = tb_student.dis_id INNER JOIN tb_province ON tb_district.province_id = tb_province.pro_id WHERE tb_register.class_id=:class_id AND tb_register.sch_id =:sch_id");
        $this->bind('class_id', $this->class_id);
        $this->bind('sch_id', $this->sch_id);
        return $this->resultset();
    }

    public function getViewStudentRegisterReport()
    {
        $this->query("SELECT * FROM `tb_student` INNER JOIN `tb_class` ON tb_class.class_id = tb_student.class_id WHERE tb_student.class_id=:class_id AND sch_id =:sch_id AND st_status =:status");
        $this->bind('class_id', $this->class_id);
        $this->bind('sch_id', $this->sch_id);
        $this->bind('status', $this->status);
        return $this->resultset();
    }


    public function getViewStudentRegisterPrint()
    {
        $this->query("SELECT * FROM `tb_student` INNER JOIN `tb_class` ON tb_class.class_id = tb_student.class_id INNER JOIN tb_sch_year ON tb_student.sch_id = tb_sch_year.sch_id WHERE tb_student.class_id=:class_id AND tb_student.sch_id =:sch_id AND st_status =:status");
        $this->bind('class_id', $this->class_id);
        $this->bind('sch_id', $this->sch_id);
        $this->bind('status', $this->status);
        return $this->resultset();
    }




    public function getClassLevel()
    {
        $this->query("SELECT * FROM `tb_class_level`");
        return $this->resultset();
    }

    public function getSch()
    {
        $this->query("SELECT * FROM `tb_sch_year`");
        return $this->resultset();
    }

    public function getProvince()
    {
        $this->query("SELECT * FROM `tb_province`");
        return $this->resultset();
    }

    public function getDistrict()
    {
        $this->query("select * from tb_district where province_id=:province_id");
        $this->bind('province_id', $this->province_id);
        return $this->resultset();

    }

    public function UpdateStudent(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_student` SET `level_id`=:level_id,`class_id`=:class_id,`st_name`=:st_name,`sex`=:sex,`mobile`=:mobile,`birthday`=:birthday,`dis_id`=:district_id,`village`=:village,`sch_id`=:sch_id WHERE `st_id`=:st_id");
            $this->bind('st_id', $this->st_id);
            $this->bind('level_id', $this->level_id);
            $this->bind('class_id', $this->class_id);
            $this->bind('st_name', $this->st_name);
            $this->bind('sex', $this->sex);
            $this->bind('mobile', $this->mobile);
            $this->bind('birthday', $this->birthday);
            $this->bind('district_id', $this->district_id);
            $this->bind('village', $this->village);
            $this->bind('sch_id', $this->sch_id);


            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function getCheckClass(){
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_class` WHERE class_name=:class_name AND level_id=:level_id");
        $this->bind('class_name', $this->class_name);
        $this->bind('level_id', $this->level_id);
        return $this->single();
    }

    public function getFormatDate($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }

    public function AddStudent(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_student` (`level_id`,`class_id`,`st_no`,`st_name`,`sex`,`mobile`,`birthday`,`dis_id`,`village`,`sch_id`,`st_status`) VALUES (:level_id,:class_id,:st_no,:st_name,:sex,:mobile,:birthday,:district_id,:village,:sch_id,1)");
            $this->bind('level_id', $this->level_id);
            $this->bind('class_id', $this->class_id);
            $this->bind('st_no', $this->st_no);
            $this->bind('st_name', $this->st_name);
            $this->bind('sex', $this->sex);
            $this->bind('mobile', $this->mobile);
            $this->bind('birthday', $this->birthday);
            $this->bind('district_id', $this->district_id);
            $this->bind('village', $this->village);
            $this->bind('sch_id', $this->sch_id);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function DeleteStudent(){
        $this->beginTransaction();
        try {
            $this->query("DELETE FROM `tb_student` WHERE `st_id`=:st_id");
            $this->bind('st_id', $this->st_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function SetStudentId($st_id){
        return $this->st_id = $st_id;
    }

    public function SetSt_Name($st_name){
        return $this->st_name = $st_name;
    }

    public function SetSex($sex){
        return $this->sex = $sex;
    }

    public function SetSt_No($st_no){
        return $this->st_no = $st_no;
    }

    public function SetMobile($mobile){
        return $this->mobile = $mobile;
    }

    public function SetVillage($village){
        return $this->village = $village;
    }

    public function SetBirthday($birthday){
        return $this->birthday = $birthday;
    }

    public function SetStatus($status){
        return $this->status = $status;
    }


    public function SetProvince($province_id){
        return $this->province_id = $province_id;
    }


    public function SetDistrict_id($district_id){
        return $this->district_id = $district_id;
    }

    public function SetClassId($class_id){
        return $this->class_id = $class_id;
    }
    public function SetLevelId($level_id){
        return $this->level_id = $level_id;
    }

    public function SetSchId($sch_id){
        return $this->sch_id = $sch_id;
    }

}