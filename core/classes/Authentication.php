<?php
class Authentication extends Database {

  private $username;
  private $password;

  public function login()
  {
    $this->query("SELECT * FROM tb_user WHERE (email = :username OR username = :username) AND password = :password");
    $this->bind("username", $this->username);
    $this->bind("password", sha1($this->password));
    return $this->resultset();
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




}
