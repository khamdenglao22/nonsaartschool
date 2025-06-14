<?php
class ClassRoom extends Database{

    private $class_id;
    private $class_name;
    private $level_id;
    private $level_name;

    public function getLevel(){
        $this->query("SELECT * FROM `tb_class_level`");
        return $this->resultset();
    }

    public function ViewClassRoom(){
        $this->query("SELECT * FROM `tb_class` INNER JOIN `tb_class_level` ON tb_class.level_id = tb_class_level.level_id WHERE tb_class.class_id=:class_id");
        $this->bind('class_id', $this->class_id);
        return $this->single();

    }

    public function UpdateClassRoom(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_class` SET `class_name`=:class_name,`level_id`=:level_id WHERE `class_id`=:class_id");
            $this->bind('class_id', $this->class_id);
            $this->bind('class_name', $this->class_name);
            $this->bind('level_id', $this->level_id);


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


    public function getClassRoom(){
        $this->query("SELECT * FROM `tb_class` INNER JOIN `tb_class_level` ON tb_class.level_id = tb_class_level.level_id ");
        return $this->resultset();
    }

    public function AddClassRoom(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_class` (`class_name`,`level_id`) VALUES (:class_name,:level_id)");
            $this->bind('class_name', $this->class_name);
            $this->bind('level_id', $this->level_id);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function DeleteClassRoom(){
        $this->beginTransaction();
        try {
            $this->query("DELETE FROM `tb_class` WHERE `class_id`=:class_id");
            $this->bind('class_id', $this->class_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }


    
    public function SetLevelId($level_id){
        return $this->level_id = $level_id;
    }
    public function SetLevelName($level_name){
        return $this->level_name = $level_name;
    }
    public function SetClassId($class_id){
        return $this->class_id = $class_id;
    }
    public function SetClassName($class_name){
        return $this->class_name = $class_name;
    }

}

?>