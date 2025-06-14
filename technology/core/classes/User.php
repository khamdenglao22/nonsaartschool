<?php

/**
 * Created by PhpStorm.
 * User: ceeb
 * Date: 2021-06-23
 * Time: 10:17 AM
 */
class User extends Database
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $firstName;
    private $lastName;
    private $mobile;
    private $phone;
    private $profileImg;
    private $role;
    private $branch;
    private $status;

    public function getUser()
    {
        $this->query("SELECT * FROM tb_user WHERE email = :email");
        $this->bind("email", $this->email);
        $this->execute();
        return $this->single();
    }

    public function addUser()
    {
        $this->query("INSERT INTO `tb_user` (`username`, `password`, `email`,`first_name`, `last_name`, `full_name`,`mobile`, `phone`, `profile_img`, role_id, status, `created`) VALUES (:username,:password,:email,:first_name,:last_name,:full_name,:mobile, :phone, :profile_img, :role_id, 1, :created)");
        $this->bind("username", $this->username);
        $password = sha1($this->password);
        $this->bind("password", $password);
        $this->bind("email", $this->email);
        $this->bind("first_name", $this->firstName);
        $this->bind("last_name", $this->lastName);
        $this->bind("full_name", $this->firstName . ' ' . $this->lastName);
        $this->bind("mobile", $this->mobile);
        $this->bind("phone", $this->phone);
        $this->bind("profile_img", $this->profileImg);
        $this->bind("role_id", $this->role);
        $this->bind("created", date('Y-m-d H:i:s'));
        return $this->execute();
    }

    public function deleteUser()
    {
//    $this->query("UPDATE `tb_user` SET `activated` = 2, deleted = 1 WHERE id = :id");
        $this->query("DELETE FROM `tb_user` WHERE id = :id");
        $this->bind("id", $this->id);
        return $this->execute();
    }

    public function editUser()
    {
        if (!empty($this->password)) {
            $this->query("UPDATE `tb_user` SET `password` = :password,`email` = :email,`first_name` = :first_name,`last_name` = :last_name,`full_name` = :full_name,`mobile` = :mobile, phone = :phone, role_id = :role_id WHERE `id` = :id");
        } else {
            $this->query("UPDATE `tb_user` SET `email` = :email,`first_name` = :first_name,`last_name` = :last_name,`full_name` = :full_name,`mobile` = :mobile, phone = :phone, role_id = :role_id WHERE `id` = :id");
        }

        $this->bind("id", $this->id);
        if (!empty($this->password)) {
            $password = sha1($this->password);
            $this->bind("password", $password);
        }
        $this->bind("email", $this->email);
        $this->bind("first_name", $this->firstName);
        $this->bind("last_name", $this->lastName);
        $this->bind("full_name", $this->firstName . ' ' . $this->lastName);
        $this->bind("mobile", $this->mobile);
        $this->bind("phone", $this->phone);
        $this->bind("role_id", $this->role);
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
