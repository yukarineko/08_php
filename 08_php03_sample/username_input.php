<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報入力画面</title>
</head>

<body>
  <form action="username_create.php" method="POST">
    <fieldset>
      <legend>ユーザー情報入力画面</legend>
      <a href="username_read.php">一覧画面</a>
      <div>
        username: <input type="username" name="username">
      </div>
      <div>
        password: <input type="password" name="password">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>