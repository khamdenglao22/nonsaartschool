<?php

class Teacher extends Database
{
    private $teach_id;
    private $teach_name;
    private $sex;
    private $ethic;
    private $status;
    private $mobile;
    private $village;
    private $district_id;
    private $province_id;
    private $position;
    private $birthday;
    private $subject;
    private $subject_level;

    public function getTeacher()
    {
        $this->query("SELECT * FROM `tb_teacher` INNER JOIN tb_district ON tb_district.dis_id = tb_teacher.dis_id INNER JOIN tb_province ON tb_district.province_id = tb_province.pro_id");
        return $this->resultset();
    }

    public function ViewTeacher(){
        $this->query("SELECT * FROM `tb_teacher` INNER JOIN tb_district ON tb_district.dis_id = tb_teacher.dis_id INNER JOIN tb_province ON tb_district.province_id = tb_province.pro_id WHERE tb_teacher.teach_id=:teach_id");
        $this->bind('teach_id', $this->teach_id);
        return $this->single();

    }

    public function AddTeacher(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_teacher` (`teach_name`,`mobile`,`birthday`,`sex`,`status`,`ethic`,`dis_id`,`village`,`subject`,`subject_level`) VALUES (:teach_name,:mobile,:birthday,:sex,:status,:ethic,:district_id,:village,:subject,:subject_level)");
            $this->bind('teach_name', $this->teach_name);
            $this->bind('mobile', $this->mobile);
            $this->bind('birthday', $this->birthday);
            $this->bind('sex', $this->sex);
            $this->bind('status', $this->status);
            $this->bind('ethic', $this->ethic);
            $this->bind('district_id', $this->district_id);
            $this->bind('village', $this->village);
            $this->bind('subject', $this->subject);
            $this->bind('subject_level', $this->subject_level);
        

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function UpdateTeacher(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_teacher` SET `teach_name`=:teach_name,`mobile`=:mobile,`birthday`=:birthday,`sex`=:sex,`status`=:status,`ethic`=:ethic,`dis_id`=:district_id,`village`=:village,`subject`=:subject,`subject_level`=:subject_level WHERE `teach_id`=:teach_id");
            $this->bind('teach_id', $this->teach_id);
            $this->bind('teach_name', $this->teach_name);
            $this->bind('mobile', $this->mobile);
            $this->bind('birthday', $this->birthday);
            $this->bind('sex', $this->sex);
            $this->bind('status', $this->status);
            $this->bind('ethic', $this->ethic);
            $this->bind('district_id', $this->district_id);
            $this->bind('village', $this->village);
            $this->bind('subject', $this->subject);
            $this->bind('subject_level', $this->subject_level);



            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function DeleteTeacher(){
        $this->beginTransaction();
        try {
            $this->query("DELETE FROM `tb_teacher` WHERE `teach_id`=:teach_id");
            $this->bind('teach_id', $this->teach_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
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

    public function getFormatDate($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }

    public function SetTeacherId($teach_id){
        return $this->teach_id = $teach_id;
    }

    public function SetTeacherName($teach_name){
        return $this->teach_name = $teach_name;
    }

    public function SetTeacherEthic($ethic){
        return $this->ethic = $ethic;
    }

    public function SetSex($sex){
        return $this->sex = $sex;
    }

    public function SetStatus($status){
        return $this->status = $status;
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

    public function SetProvince($province_id){
        return $this->province_id = $province_id;
    }

    public function SetDistrict_id($district_id){
        return $this->district_id = $district_id;
    }

    public function SetPosition($position){
        return $this->position = $position;
    }

    public function SetSubject($subject){
        return $this->subject = $subject;
    }

    public function SetSubjectLevel($subject_level){
        return $this->subject_level = $subject_level;
    }


}