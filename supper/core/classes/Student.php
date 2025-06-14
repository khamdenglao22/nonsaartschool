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

    private $sub_id;
    private $month;

 

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

    public function getViewScoreMonth()
    {
        $this->query("SELECT * FROM tb_score INNER JOIN tb_student ON tb_score.st_id = tb_student.st_id where tb_score.sch_id=:sch_id AND tb_score.class_id=:class_id AND sub_id=:sub_id AND month=:month");
        $this->bind('sch_id', $this->sch_id);
        $this->bind('class_id', $this->class_id);
        $this->bind('sub_id', $this->sub_id);
        $this->bind('month', $this->month);

        return $this->resultset();

    }

    public function getPrintScoreMonth()
    {
        $this->query("SELECT * FROM tb_score INNER JOIN tb_student ON tb_score.st_id = tb_student.st_id INNER JOIN tb_class ON tb_score.class_id = tb_class.class_id INNER JOIN tb_subject ON tb_score.sub_id = tb_subject.sub_id INNER JOIN tb_sch_year ON tb_score.sch_id = tb_sch_year.sch_id where tb_score.sch_id=:sch_id AND tb_score.class_id=:class_id AND tb_score.sub_id=:sub_id AND month=:month");
        $this->bind('sch_id', $this->sch_id);
        $this->bind('class_id', $this->class_id);
        $this->bind('sub_id', $this->sub_id);
        $this->bind('month', $this->month);

        return $this->resultset();

    }

    public function getViewRecipeReport(){
        // $this->query("SELECT * FROM `tb_register` INNER JOIN `tb_student` ON tb_register.st_id = tb_student.st_id INNER JOIN tb_class ON tb_register.class_id = tb_class.class_id INNER JOIN tb_sch_year ON tb_register.sch_id = tb_sch_year.sch_id INNER JOIN tb_user ON tb_register.user_id = tb_user.user_id INNER JOIN tb_teacher ON tb_user.teach_id = tb_teacher.teach_id WHERE tb_register.st_id=:st_id AND tb_register.sch_id=:sch_id");
        $this->query("SELECT SUM(pay) AS price,level_name,COUNT(st_id) AS student,pay FROM `tb_register` INNER JOIN tb_class_level ON tb_register.level_id=tb_class_level.level_id WHERE sch_id=:sch_id GROUP BY tb_register.level_id");
        $this->bind('sch_id', $this->sch_id);
        return $this->resultset();
    }

    public function getPrintStudentScore()
    {
        $this->query("SELECT * FROM tb_score INNER JOIN tb_student ON tb_score.st_id = tb_student.st_id INNER JOIN tb_class ON tb_score.class_id = tb_class.class_id INNER JOIN tb_subject ON tb_score.sub_id = tb_subject.sub_id INNER JOIN tb_sch_year ON tb_score.sch_id = tb_sch_year.sch_id INNER JOIN tb_user ON tb_score.user_id = tb_user.user_id INNER JOIN tb_teacher ON tb_user.teach_id = tb_teacher.teach_id where tb_score.sch_id=:sch_id AND tb_score.class_id=:class_id AND tb_score.sub_id=:sub_id AND month=:month AND tb_score.user_id=:user_id");
        $this->bind('sch_id', $this->sch_id);
        $this->bind('class_id', $this->class_id);
        $this->bind('sub_id', $this->sub_id);
        $this->bind('month', $this->month);
        $this->bind('user_id', $this->user_id);

        return $this->resultset();

    }

    public function getViewStudentReport()
    {
        $this->query("SELECT * FROM `tb_register` INNER JOIN `tb_class` ON tb_class.class_id = tb_register.class_id INNER JOIN tb_student ON tb_register.st_id = tb_student.st_id INNER JOIN tb_district ON tb_district.dis_id = tb_student.dis_id INNER JOIN tb_province ON tb_district.province_id = tb_province.pro_id WHERE tb_register.class_id=:class_id AND tb_register.sch_id =:sch_id");
        $this->bind('class_id', $this->class_id);
        $this->bind('sch_id', $this->sch_id);
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

    public function getFormatDate($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
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

    
    public function SetMonth($month){
        return $this->month = $month;
    }

    public function SetSubjectId($sub_id){
        return $this->sub_id = $sub_id;
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