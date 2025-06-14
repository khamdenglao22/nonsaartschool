<?php


class Report extends Database
{

    private $sub_id;
    private $teach_id;
    private $class_id;
    private $sch_id;
    private $level_id;
    private $score;
    private $month;
    private $user_id;
    private $st_no;


    public function getViewSubject()
    {
        $this->query("SELECT * FROM tb_teaching INNER JOIN tb_subject ON tb_teaching.sub_id = tb_subject.sub_id INNER JOIN tb_class ON tb_teaching.class_id = tb_class.class_id INNER JOIN tb_teacher ON tb_teaching.teach_id = tb_teacher.teach_id INNER JOIN tb_sch_year ON tb_teaching.sch_id = tb_sch_year.sch_id where tb_teaching.sch_id=:sch_id AND tb_teaching.teach_id=:teach_id");
        $this->bind('sch_id', $this->sch_id);
        $this->bind('teach_id', $this->teach_id);
        return $this->resultset();
    }



    public function getViewStudentScore()
    {
        $this->query("SELECT * FROM tb_score INNER JOIN tb_student ON tb_score.st_id = tb_student.st_id where tb_score.sch_id=:sch_id AND tb_score.class_id=:class_id AND sub_id=:sub_id AND month=:month AND user_id=:user_id");
        $this->bind('sch_id', $this->sch_id);
        $this->bind('class_id', $this->class_id);
        $this->bind('sub_id', $this->sub_id);
        $this->bind('month', $this->month);
        $this->bind('user_id', $this->user_id);

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
