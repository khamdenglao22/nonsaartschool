<?php
class Level extends Database{

    private $level_id;
    private $level_name;

    public function getLevel(){
        $this->query("SELECT * FROM `tb_class_level`");
        return $this->resultset();
    }

    public function AddLevel(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_class_level` (`level_name`) VALUES (:level_name)");
            $this->bind('level_name', $this->level_name);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function getCheck()
    {
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_class_level` WHERE level_name=:level_name");
        $this->bind('level_name', $this->level_name);
        return $this->single();
    }

    public function DeleteLevel(){
        $this->beginTransaction();
        try {
            $this->query("DELETE FROM `tb_class_level` WHERE `level_id`=:level_id");
            $this->bind('level_id', $this->level_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function UpdateLevel(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_class_level` SET `level_name`=:level_name WHERE `level_id`=:level_id");
            $this->bind('level_id', $this->level_id);
            $this->bind('level_name', $this->level_name);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function SetId($level_id){
        return $this->level_id = $level_id;
    }
    public function SetName($level_name){
        return $this->level_name = $level_name;
    }
}

?>