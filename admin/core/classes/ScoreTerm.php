<?php

class ScoreTerm extends Database
{
    private $score_id;
    private $st_id;
    private $teach_id;
    private $class_id;
    private $level_id;
    private $sub_id;
    private $sch_id;
    private $score;
    private $month;
    private $user_id;
    private $st_no;



    public function getSch()
    {
        $this->query("SELECT * FROM `tb_sch_year`");
        return $this->resultset();
    }


    public function getSubject()
    {
        $this->query("SELECT * FROM `tb_subject`");
        return $this->resultset();
    }

    public function getLevel()
    {
        $this->query("SELECT * FROM `tb_class_level`");
        return $this->resultset();
    }

    public function getViewStudentTerm()
    {
        $this->query("SELECT * FROM tb_student where sch_id=:sch_id AND class_id=:class_id AND st_status=2");
        $this->bind('sch_id', $this->sch_id);
        $this->bind('class_id', $this->class_id);
        return $this->resultset();
    }

    public function getCheckTerm()
    {
        $this->query("SELECT COUNT(*) AS cnt FROM `tb_score` WHERE class_id=:class_id AND sub_id=:sub_id AND sch_id=:sch_id AND month=:month");
        $this->bind('class_id', $this->class_id);
        $this->bind('sub_id', $this->sub_id);
        $this->bind('sch_id', $this->sch_id);
        $this->bind('month', $this->month);
        return $this->single();
    }

    public function ViewScoreUpdateTerm()
    {
        $this->query("SELECT * FROM `tb_score` INNER JOIN tb_student ON tb_score.st_id = tb_student.st_id WHERE score_id=:score_id");
        $this->bind('score_id', $this->score_id);
        return $this->single();
    }

    public function UpdateScoreTerm()
    {

        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_score` SET `score`=:score WHERE  `score_id`=:score_id");
            $this->bind('score_id', $this->score_id);
            $this->bind('score', $this->score);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }

    public function AddScoreTerm()
    {
        $this->beginTransaction();
        try {

            $st_id = explode(",", $this->st_id);
            $score = explode(",", $this->score);


            for ($y = 0; $y < count($st_id); $y++) {
                if ($st_id[$y] != 0) {

                    $this->query("INSERT INTO `tb_score` (`st_id`,`class_id`,`sub_id`,`score`,`sch_id`,`month`,`user_id`) VALUES (:st_id,:class_id,:sub_id,:score,:sch_id,:month,:user_id)");
                    $this->bind('st_id', $st_id[$y]);
                    $this->bind('class_id', $this->class_id);
                    $this->bind('sub_id', $this->sub_id);
                    $this->bind('score', $score[$y]);
                    $this->bind('sch_id', $this->sch_id);
                    $this->bind('month', $this->month);
                    $this->bind('user_id', $this->user_id);
                    $result = $this->execute();
                }
            }


            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }


    public function SetStudentId($st_id)
    {
        return $this->st_id = $st_id;
    }

    public function SetScoreId($score_id)
    {
        return $this->score_id = $score_id;
    }


    public function SetTeacherId($teach_id)
    {
        return $this->teach_id = $teach_id;
    }

    public function SetScore($score)
    {
        return $this->score = $score;
    }

    public function SetMonth($month)
    {
        return $this->month = $month;
    }

    public function SetUserId($user_id)
    {
        return $this->user_id = $user_id;
    }

    public function SetSt_No($st_no)
    {
        return $this->st_no = $st_no;
    }

    public function SetSubjectId($sub_id)
    {
        return $this->sub_id = $sub_id;
    }


    public function SetClassId($class_id)
    {
        return $this->class_id = $class_id;
    }
    public function SetLevelId($level_id)
    {
        return $this->level_id = $level_id;
    }

    public function SetSchId($sch_id)
    {
        return $this->sch_id = $sch_id;
    }
}
