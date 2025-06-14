<?php

/**
 * Created by PhpStorm.
 * User: ceeb
 * Date: 2021-06-23
 * Time: 10:17 AM
 */
class User extends Database
{
    private $user_id;
    private $username;
    private $password;
    private $teach_id;

    private $status;

    public function getTeacher(){
        $this->query("SELECT * FROM `tb_teacher`");
        return $this->resultset();
    }

    public function getUser(){
        $this->query("SELECT u.*, u.status AS user_status,t.status As teach_status,t.teach_name As teach_name FROM `tb_user` u INNER JOIN tb_teacher t ON u.teach_id = t.teach_id");
        return $this->resultset();
    }

    // public function getUser()
    // {
    //     $this->query("SELECT * FROM tb_user WHERE email = :email");
    //     $this->bind("email", $this->email);
    //     $this->execute();
    //     return $this->single();
    // }

    public function AddUser()
    {
        $this->query("INSERT INTO `tb_user` (`username`, `password`, `status`,`teach_id`, `created`) VALUES (:username,:password,:status,:teach_id,:created)");
        $this->bind("username", $this->username);
        $password = sha1($this->password);
        $this->bind("password", $password);
        $this->bind("teach_id", $this->teach_id);
        $this->bind("status", $this->status);
        $this->bind("created", date('Y-m-d H:i:s'));
        return $this->execute();
    }

    public function getViewUser(){
        $this->query("SELECT u.*, u.status AS user_status,t.status As teach_status,t.teach_name As teach_name FROM `tb_user` u INNER JOIN tb_teacher t ON u.teach_id = t.teach_id WHERE u.user_id=:user_id");
        $this->bind('user_id', $this->user_id);
        return $this->single();
    }

    public function DeleteUser()
    {
//    $this->query("UPDATE `tb_user` SET `activated` = 2, deleted = 1 WHERE id = :id");
        $this->query("DELETE FROM `tb_user` WHERE user_id = :user_id");
        $this->bind("user_id", $this->user_id);
        return $this->execute();
    }

    public function editUser()
    {
        if (!empty($this->password)) {
            $this->query("UPDATE `tb_user` SET `username`=:username, `password`=:password, `status`=:status,`teach_id`=:teach_id, `updated`=:updated WHERE `user_id` = :user_id");
        } else {
            $this->query("UPDATE `tb_user` SET `username`=:username, `status`=:status,`teach_id`=:teach_id, `updated`=:updated WHERE `user_id` = :user_id");
        }

        $this->bind("user_id", $this->user_id);
        if (!empty($this->password)) {
            $password = sha1($this->password);
            $this->bind("password", $password);
        }
        $this->bind("username", $this->username);
        $this->bind("teach_id", $this->teach_id);
        $this->bind("status", $this->status);
        $this->bind("updated", date('Y-m-d H:i:s'));
        return $this->execute();
    }

    public function resetPassword()
    {
        $this->query("UPDATE `tb_user` SET `password` = :password WHERE `email` = :email");
        $this->bind("email", $this->email);
        $this->bind("password", sha1($this->password));
        return $this->execute();
    }

    public function updateStatus()
    {
        $this->query("UPDATE `tb_user` SET `status` = :status WHERE `id` = :id");
        $this->bind("status", $this->status);
        $this->bind("id", $this->id);
        return $this->execute();
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setTeachId($teach_id)
    {
        return $this->teach_id = $teach_id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getProfileImg()
    {
        return $this->profileImg;
    }

    /**
     * @param mixed $profileImg
     */
    public function setProfileImg($profileImg)
    {
        $this->profileImg = $profileImg;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * @param mixed $branch
     */
    public function setBranch($branch)
    {
        $this->branch = $branch;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}
