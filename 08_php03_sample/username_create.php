<?php
// DB接続したいファイル（company_create.php, company_read.php, など）

include('functions.php');

//var_dump($_POST);
//exit();
// POSTデータ確認
if(
  //だめな条件
  !isset($_POST["username"])|| $_POST["username"] === "" ||
  !isset($_POST["password"])|| $_POST["password"] === ""  
){
exit("paramError");
}

$username = $_POST["username"];
$password = $_POST["password"];
//$is_admin = $_POST["is_admin"];

// DB接続
$dbn ='mysql:dbname=gs_d13_00;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// SQL作成&実行
$sql = "INSERT INTO users_table(id, username, password, is_admin,created_at, updated_at,deleted_at) VALUES(NULL, :username, :password,:is_admin,now(),now(), NULL)";

$stmt = $pdo->prepare($sql);
// バインド変数を設定
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':is_admin', 0);


//SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:username_input.php");
exit();