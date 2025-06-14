<?php
class Subject extends Database{

    private $sub_id;
    private $sub_name;

    public function getSubject(){
        $this->query("SELECT * FROM `tb_subject`");
        return $this->resultset();
    }

    public function getCheck()
    {
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_subject` WHERE sub_name=:sub_name");
        $this->bind('sub_name', $this->sub_name);
        return $this->single();
    }

    public function AddSubject(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_subject` (`sub_name`) VALUES (:sub_name)");
            $this->bind('sub_name', $this->sub_name);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function UpdateSubject(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_subject` SET `sub_name`=:sub_name WHERE `sub_id`=:sub_id");
            $this->bind('sub_id', $this->sub_id);
            $this->bind('sub_name', $this->sub_name);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;

    }

    public function DeleteSubject(){
        $this->beginTransaction();
        try {
            $this->query("DELETE FROM `tb_subject` WHERE `sub_id`=:sub_id");
            $this->bind('sub_id', $this->sub_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }


    public function SetSubId($sub_id){
        return $this->sub_id = $sub_id;
    }
    public function SetSubName($sub_name){
        return $this->sub_name = $sub_name;
    }

}

?>