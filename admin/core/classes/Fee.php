<?php
class Fee extends Database{

    private $fee_id;
    private $price;
    private $level_id;
    private $sch_id;

    public function getFee(){
        $this->query("SELECT * FROM `tb_school_fee` INNER JOIN tb_class_level ON tb_school_fee.level_id=tb_class_level.level_id INNER JOIN tb_sch_year ON tb_school_fee.sch_id=tb_sch_year.sch_id");
        return $this->resultset();
    }

    public function getLevel(){
        $this->query("SELECT * FROM `tb_class_level`");
        return $this->resultset();
    }

    public function getSch(){
        $this->query("SELECT * FROM `tb_sch_year`");
        return $this->resultset();
    }

    public function AddSchoolFee(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_school_fee` (`level_id`,`price`,`sch_id`) VALUES (:level_id,:price,:sch_id)");
            $this->bind('level_id', $this->level_id);
            $this->bind('price', $this->price);
            $this->bind('sch_id', $this->sch_id);

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

    public function DeleteFee(){
        $this->beginTransaction();
        try {
            $this->query("DELETE FROM `tb_school_fee` WHERE `school_id`=:fee_id");
            $this->bind('fee_id', $this->fee_id);
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

    public function SetFeeId($fee_id){
        return $this->fee_id = $fee_id;
    }
    public function SetPrice($price){
        return $this->price = $price;
    }

    public function SetLevelId($level_id){
        return $this->level_id = $level_id;
    }

    public function SetSchId($sch_id){
        return $this->sch_id = $sch_id;
    }
}

?>