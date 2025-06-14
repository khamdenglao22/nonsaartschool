<?php

class UpdateLevel extends Database
{

    private $level_id;
    private $sch_id;

    private $new_level_id;
    private $new_sch_id;


    public function getSch()
    {
        $this->query("SELECT * FROM `tb_sch_year` ORDER BY sch_id DESC");
        return $this->resultset();
    }


    public function getLevel()
    {
        $this->query("select * from tb_class_level");
        return $this->resultset();
    }

    // public function getCheck()
    // {
    //     $this->query("SELECT COUNT(*) AS cnt FROM `tb_student` WHERE level_id =:new_level_id AND sch_id=:sch_id");
    //     $this->bind('new_level_id', $this->new_level_id);
    //     $this->bind('sch_id', $this->sch_id);
    //     return $this->single();
    // }

    public function getCheckSch()
    {
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_register` WHERE sch_id=:new_sch_id");
        $this->bind('new_sch_id', $this->new_sch_id);
        return $this->single();
    }


    public function AddUpdateLevel()
    {
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_student` SET `level_id`=:new_level_id,`sch_id`=:new_sch_id,`st_status`= 1 WHERE `sch_id`=:sch_id AND `level_id`=:level_id AND `st_status`= 2");
            $this->bind('sch_id', $this->sch_id);
            $this->bind('level_id', $this->level_id);
            $this->bind('new_level_id', $this->new_level_id);
            $this->bind('new_sch_id', $this->new_sch_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }


    public function AddUpdateSchYear()
    {
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_student` SET `sch_id`=:new_sch_id WHERE `st_status`= 1");

            $this->bind('new_sch_id', $this->new_sch_id);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }


    public function SetLevelId($level_id)
    {
        return $this->level_id = $level_id;
    }

    public function SetSchId($sch_id)
    {
        return $this->sch_id = $sch_id;
    }

    public function SetNewLevelId($new_level_id)
    {
        return $this->new_level_id = $new_level_id;
    }

    public function SetNewSchId($new_sch_id)
    {
        return $this->new_sch_id = $new_sch_id;
    }
}
