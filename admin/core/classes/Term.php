<?php

class Term extends Database{

    private $term_id;
    private $term_name;


    public function getTerm(){
        $this->query("SELECT * FROM `tb_term`");
        return $this->resultset();
    }

    public function getCheck()
    {
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_term` WHERE term_name=:term_name");
        $this->bind('term_name', $this->term_name);
        return $this->single();
    }

    public function AddTerm(){
        $this->beginTransaction();
        try {
            $this->query("INSERT INTO `tb_term` (`term_name`) VALUES (:term_name)");
            $this->bind('term_name', $this->term_name);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function DeleteTerm(){
        $this->beginTransaction();
        try {
            $this->query("DELETE FROM `tb_term` WHERE `term_id`=:term_id");
            $this->bind('term_id', $this->term_id);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function UpdateTerm(){
        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_term` SET `term_name`=:term_name WHERE `term_id`=:term_id");
            $this->bind('term_id', $this->term_id);
            $this->bind('term_name', $this->term_name);

            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }


    public function SetId($term_id){
        return $this->term_id = $term_id;
    }
    public function SetName($term_name){
        return $this->term_name = $term_name;
    }



}


?>