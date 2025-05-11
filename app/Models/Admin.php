<?php
namespace App\Models;
use App\Core\Database;
require_once __DIR__ . '/../Core/Database.php';

class Admin
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = Database::connect();
  }

  public function getByUsername(string $username)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM dating_app_user WHERE username = ? AND is_admin = 1");
    $stmt->execute([$username]);
    return $stmt->fetch();
  }

  public function getAllUsers()
  {
    $stmt = $this->pdo->query("SELECT id, username, email, bio FROM dating_app_user ORDER BY id ASC");
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function deleteUserById($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM dating_app_user WHERE id = ?");
    return $stmt->execute([$id]);
  }
}
