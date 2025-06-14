<?php
require_once __DIR__ . '/Database.php';

/**
 * Created by PhpStorm.
 * User: ceeb
 * Date: 8/1/17
 * Time: 9:03 PM
 */
class Role
{
  protected $permissions;

  protected function __construct()
  {
    $this->permissions = array();
  }

  // return a role object with associated permissions
  public static function getRolePerms($role_id)
  {
    $role = new Role();
    $sql = "SELECT t2.id, t2.description FROM tb_role_permission as t1
                JOIN tb_permission as t2 ON t1.permission_id = t2.id
                WHERE t1.role_id = :role_id";
    $db = new Database();
    $db->query($sql);
    $db->bind(":role_id", $role_id);
    $db->execute();
    $rows = $db->resultset();
    foreach ($rows as $row) {
      $role->permissions[$row["description"]] = true;
    }
    return $role;
  }

  // return a role object with associated permissions for view
  public static function getRolePermsViewer($parent)
  {
    $sql = "SELECT t1.id AS role_id, t2.id, t2.description, t2.description_la, t2.parent FROM tb_role_permission as t1
                RIGHT OUTER JOIN tb_permission as t2 ON t1.permission_id = t2.id WHERE t2.parent = $parent GROUP BY t2.id ORDER BY t2.parent, t2.description, t2.description_la, t2.parent ASC";
    $db = new Database();
    $db->query($sql);
    return $db->resultset();
  }

  // get role permission
  public static function checkRolePermission($role_id, $perm_id) {
    $sql = "SELECT t1.id AS role_id, t2.id, t2.description, t2.description_la, t2.parent FROM tb_role_permission as t1
                JOIN tb_permission as t2 ON t1.permission_id = t2.id WHERE t1.role_id = :role_id AND t1.permission_id = :perm_id";
    $db = new Database();
    $db->query($sql);
    $db->bind(":role_id", $role_id);
    $db->bind(":perm_id", $perm_id);
    $rows = $db->resultset();
    $count = count($rows);
    if ($count > 0) return true;
    return false;
  }
  // check if a permission is set
  public function hasPerm($permission)
  {
    return isset($this->permissions[$permission]);
  }

  // insert a new role
  public static function insertRole($role_name)
  {
    $sql = "INSERT INTO tb_role (name, created) VALUES (:role_name, NOW())";
    $db = new Database();
    $db->query($sql);
    $db->bind(":role_name", $role_name);
    return $db->execute();
  }

  // update role name
  public static function updateRole($id, $name)
  {
    $sql = "UPDATE tb_role SET name = :name WHERE id = :id";
    $db = new Database();
    $db->query($sql);
    $db->bind(":id", $id);
    $db->bind(":name", $name);
    return $db->execute();
  }

// insert array of roles for specified user id
  public static function insertUserRoles($user_id, $roles)
  {
    $sql = "INSERT INTO tb_user_role (user_id, role_id) VALUES (:user_id, :role_id)";
    $db = new Database();
    $db->query($sql);
    $db->bind(":user_id", $user_id, PDO::PARAM_STR);
    foreach ($roles as $role_id) {
      $db->bind(":role_id", $role_id, PDO::PARAM_INT);
      $db->execute();
    }
    return true;
  }

  // delete array of roles, and all associations
  public static function deleteRoles($roles)
  {
    $sql = "DELETE t1, t2, t3 FROM tb_role as t1
            LEFT OUTER JOIN tb_user_role as t2 on t1.id = t2.role_id
            LEFT OUTER JOIN tb_role_permission as t3 on t1.id = t3.role_id
            WHERE t1.id = :role_id";
    $db = new Database();
    $db->query($sql);
    foreach ($roles as $role_id) {
      $db->bind(":role_id", $role_id, PDO::PARAM_INT);
      $db->execute();
    }
    return true;
  }

  // delete ALL roles for specified user id
  public static function deleteUserRoles($user_id)
  {
    $sql = "DELETE FROM tb_user_role WHERE user_id = :user_id";
    $db = new Database();
    $db->query($sql);
    $db->bind(":user_id", $user_id);
    return $db->execute();
  }
}
