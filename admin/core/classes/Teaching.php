<?php
class Teaching extends Database{

    private $teaching_id;
    private $teach_id;
    private $sub_id;
    private $class_id;
    private $level_id;
    private $sch_id;
    

    public function getTeaching(){
        $this->query("SELECT * FROM `tb_teaching` INNER JOIN tb_teacher ON tb_teaching.teach_id = tb_teacher.teach_id INNER JOIN tb_subject ON tb_teaching.sub_id = tb_subject.sub_id INNER JOIN tb_class ON tb_teaching.class_id = tb_class.class_id INNER JOIN tb_sch_year ON tb_teaching.sch_id = tb_sch_year.sch_id");
        return $this->resultset();
    }

    public function getViewTeaching(){
        $this->query("SELECT * FROM `tb_teaching` INNER JOIN tb_teacher ON tb_teaching.teach_id = tb_teacher.teach_id INNER JOIN tb_subject ON tb_teaching.sub_id = tb_subject.sub_id INNER JOIN tb_class ON tb_teaching.class_id = tb_class.class_id INNER JOIN tb_class_level ON tb_class.level_id = tb_class_level.level_id INNER JOIN tb_sch_year ON tb_teaching.sch_id = tb_sch_year.sch_id WHERE teaching_id=:teaching_id");
        $this->bind('teaching_id', $this->teaching_id);
        return $this->single();
    }

    public function getTeacher(){
        $this->query("SELECT * FROM `tb_teacher`");
        return $this->resultset();
    }

    public function getSubject(){
        $this->query("SELECT * FROM `tb_subject`");
        return $this->resultset();
    }

    public function getClassLevel(){
        $this->query("SELECT * FROM `tb_class_level`");
        return $this->resultset();
    }

    public function getSch(){
        $this->query("SELECT * FROM `tb_sch_year`");
        return $this->resultset();
    }

    public function getCheckTeaching(){
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_teaching` WHERE class_id=:class_id AND sub_id=:sub_id AND sch_id=:sch_id AND teach_id=:teach_id");
        $this->bind('class_id', $this->class_id);
        $this->bind('sub_id', $this->sub_id);
        $this->bind('teach_id', $this->teach_id);
        $this->bind('sch_id', $this->sch_id);
        return $this->single();
    }

    public function getCheckTeachingSubject(){
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_teaching` WHERE class_id=:class_id AND sub_id=:sub_id AND sch_id=:sch_id");
        $this->bind('class_id', $this->class_id);
        $this->bind('sub_id', $this->sub_id);
        $this->bind('sch_id', $this->sch_id);
        return $this->single();
    }

    public function getLevel()
    {
        $this->query("select * from tb_class where level_id=:level_id");
        $this->bind('level_id', $this->level_id);
        return $this->resultset();

    }

    public function AddTeaching(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_teaching` (`teach_id`,`sub_id`,`class_id`,`sch_id`) VALUES (:teach_id,:sub_id,:class_id,:sch_id)");
            $this->bind('teach_id', $this->teach_id);
            $this->bind('sub_id', $this->sub_id);
            $this->bind('class_id', $this->class_id);
            $this->bind('sch_id', $this->sch_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function UpdateTeaching(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_teaching` SET `teach_id`=:teach_id,`sub_id`=:sub_id,`class_id`=:class_id,`sch_id`=:sch_id WHERE `teaching_id`=:teaching_id");
            $this->bind('teaching_id', $this->teaching_id);
            $this->bind('teach_id', $this->teach_id);
            $this->bind('sub_id', $this->sub_id);
            $this->bind('class_id', $this->class_id);
            $this->bind('sch_id', $this->sch_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;

    }

    public function DeleteTeaching()
    {
        $this->query("DELETE FROM `tb_teaching` WHERE teaching_id = :teaching_id");
        $this->bind("teaching_id", $this->teaching_id);
        return $this->execute();
    }


    public function SetTeachingId($teaching_id){
        return $this->teaching_id = $teaching_id;
    }
    
    public function SetTeacherId($teach_id){
        return $this->teach_id = $teach_id;
    }

    public function SetSubId($sub_id){
        return $this->sub_id = $sub_id;
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

?>