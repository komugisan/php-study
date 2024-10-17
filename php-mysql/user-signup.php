<?php
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = 'goma1225';

    // PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=userlist;charset=UTF8;', $username, $password);


    // フォームから書籍タイトルが送信されていればデータベースに保存する
    if (array_key_exists('user_name', $_POST)) {
        // 実行するSQLを作成
        $sql = 'INSERT INTO users (user_name,mail) VALUES(:user_name,:mail);';
        // ユーザ入力に依存するSQLを実行するので、セキュリティ対策をする
        $statement = $database->prepare($sql);
        // ユーザ入力データ($_POST['book_title'])をVALUES(?)の?の部分に代入する
        $statement->bindParam(':user_name', $_POST['user_name']);
        $statement->bindParam(':mail', $_POST['mail']);
        // SQL文を実行する
        $statement->execute();
        // ステートメントを破棄する
        $statement = null;
    }

    // 実行するSQLを作成
    $sql = 'SELECT * FROM users ORDER BY created_at DESC';
    // SQLを実行する
    $statement = $database->query($sql);
    // 結果レコード（ステートメントオブジェクト）を配列に変換する
    $records = $statement->fetchAll();

    // ステートメントを破棄する
    $statement = null;

    // MySQLを使った処理が終わると、接続は不要なので切断する
    $database = null;
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>USER SIGN UP</title>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.6.1/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com/3.4.1"></script>
    </head>
    <body class="mt-4">
        <div class="mx-auto w-3/4">
            <h1 class="font-bold text-5xl text-blue-600 my-2"><a href="user-signup.php">USER SIGN UP</a></h1>

            <h2 class="text-4xl my-2">ユーザー登録フォーム</h2>
            <form action="user-signup.php" method="POST" class="flex">
                <div class="form-control w-3/4 my-4 flex-1">
                    <!-- フォームの基本 -->
                    <input type="text" name="user_name" required placeholder="ユーザー名を入力" class="input input-bordered w-3/4 text-xl">
                    <input type="text" name="mail" required placeholder="メールアドレスを入力" class="input input-bordered w-3/4 text-xl">
                </div>
                <div class="w-1/4 my-4 flex-1">
                    <button type="submit" name="submit_add_book" class="bg-blue-600 hover:bg-blue-500 text-white rounded px-4 py-2">登録</button>
                </div>
            </form>

            <hr />

            <h2 class="text-4xl my-2">登録されたユーザ一覧</h2>
            <ul class="list-disc text-lg ml-16">
            <?php
    if ($records) {
        foreach ($records as $record) {
            $user_info =  "name:" . $record['user_name'] . "　mail:" .$record['mail'] ;
?>
                    <li><?php print htmlspecialchars($user_info, ENT_QUOTES, "UTF-8"); ?></li>
<?php
        }
    }
?>
            </ul>
        </div>
    </body>
</html>