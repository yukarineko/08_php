<?php
// var_dump($_GET);
// exit();

include("matching.php");

// id受け取り
$id = $_GET['id'];
//$id = 2;


// DB接続
$pdo = matching();

// SQL実行
$sql = 'SELECT * FROM company02_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($record);
exit();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報入力画面</title>
</head>

<body>
  <form action="username_update.php" method="POST">
    <fieldset>
      <legend>ユーザー情報入力画面</legend>
      <a href="username_read.php">入力画面</a>
      <div>
        username: <input type="username" name="username" value="<?= $record['username'] ?>">
      </div>
      <div>
        password: <input type="password" name="password" value="<?= $record['password'] ?>">
      </div>
      <div>
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
    </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>