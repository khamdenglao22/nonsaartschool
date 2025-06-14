<?php
class SchoolYear extends Database{

    private $sch_id;
    private $sch_name;


    public function getSchoolYear(){
        $this->query("SELECT * FROM `tb_sch_year`");
        return $this->resultset();
    }

    public function getCheck()
    {
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_sch_year` WHERE sch_name=:sch_name");
        $this->bind('sch_name', $this->sch_name);
        return $this->single();
    }

    public function DeleteSch(){
        $this->beginTransaction();
        try {
            $this->query("DELETE FROM `tb_sch_year` WHERE `sch_id`=:sch_id");
            $this->bind('sch_id', $this->sch_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function UpdateSch(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_sch_year` SET `sch_name`=:sch_name WHERE `sch_id`=:sch_id");
            $this->bind('sch_id', $this->sch_id);
            $this->bind('sch_name', $this->sch_name);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function AddSchoolYear(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_sch_year` (`sch_name`) VALUES (:sch_name)");
            $this->bind('sch_name', $this->sch_name);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function SetId($sch_id){
        return $this->sch_id = $sch_id;
    }

    public function SetName($sch_name){
        return $this->sch_name = $sch_name;
    }


}