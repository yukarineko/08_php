<?php
// DB接続したいファイル（company_create.php, company_read.php, など）

include('matching.php');
$pdo = matching();

// 他のDB接続が必要なファイルでも上記の2行でOK！

// $sql = 'SELECT * FROM users_table ORDER BY deadline ASC';
$sql = 'SELECT * FROM company02_table ORDER BY created_at ASC';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
//exit();
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["name"]}</td>
      <td>{$record["place"]}</td>
      <td>{$record["email"]}</td>
      <td>{$record["grade"]}</td>
      <td>{$record["season"]}</td>
      <td>{$record["teach"]}</td>
      <td>{$record["detail"]}</td>
      <td>{$record["kind"]}</td>
      <td>{$record["kind2"]}</td>
      <td>{$record["detail2"]}</td>
      <td>
        <a href='company_edit.php?id={$record["id"]}'>edit</a>
      </td>
      <td>
        <a href='company_delete.php?id={$record["id"]}'>delete</a>
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
  <title>授業申し込みフォーム</title>
</head>

<body>
  <fieldset>
    <legend>授業申し込みフォーム</legend>
    <a href="company_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>name</th>
          <th>place</th>
          <th>email</th>
          <th>grade</th>
          <th>season</th>
          <th>teach</th>
          <th>detail</th>
          <th>kind</th>
          <th>kind2</th>
          <th>detail2</th>
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