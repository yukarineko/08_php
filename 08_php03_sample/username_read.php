<?php
// DB接続したいファイル（username_create.php, username_read.php, など）

include('functions.php');
$pdo = connect_to_db();

// 他のDB接続が必要なファイルでも上記の2行でOK！

// $sql = 'SELECT * FROM users_table ORDER BY deadline ASC';
$sql = 'SELECT * FROM users_table ORDER BY created_at ASC';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["username"]}</td>
      <td>{$record["password"]}</td>
      <td>
        <a href='username_edit.php?id={$record["id"]}'>edit</a>
      </td>
      <td>
        <a href='username_delete.php?id={$record["id"]}'>delete</a>
      </td>
    </tr>
  ";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報入力画面</title>
</head>

<body>
  <fieldset>
    <legend>ユーザー情報入力画面</legend>
    <a href="username_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>username</th>
          <th>password</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>