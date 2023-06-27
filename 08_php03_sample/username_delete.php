<?php
// データ受け取り
//var_dump($_GET);
//exit();
include('functions.php');
$pdo = connect_to_db();

// DB接続
$id = $_GET['id'];


$pdo = connect_to_db();
// SQL実行
$sql = 'DELETE FROM users_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:username_read.php");
exit();