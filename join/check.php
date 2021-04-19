<?php

// セッションがあるかを判定してからスタートする
if (!isset($_SESSION)) {
    session_start();
}

// db接続するテンプレを呼び出し
require_once('../dbconnect.php');

// function関数のファイルを呼び出し
require_once('../myfunc.php');

if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    die();
}

// dbテーブル内のdatetime取得のため変数を用意
$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');

// 登録ボタンを押したらデータをdbに挿入する
if (!empty($_POST)) {
    try {
        // 挿入するsql文準備
        $sql = "INSERT INTO ";
        $sql .= "members ";
        $sql .= "(name, email, password, created) ";
        $sql .= "VALUES ";
        $sql .= "(?, ?, ?, ?)";

        // sql文の準備
        $stmt = $dbh->prepare($sql);

        // 値の代入?を使う場合
        // 登録画面で投入データをSESSION配列に挿入しているのでこのデータを利用
        $stmt->bindValue(1, $_SESSION['join']['name'], PDO::PARAM_STR);
        $stmt->bindValue(2, $_SESSION['join']['email'], PDO::PARAM_STR);
        $stmt->bindValue(3, sha1($_SESSION['join']['password']), PDO::PARAM_STR);
        $stmt->bindValue(4, $date, PDO::PARAM_STR);

        // sql文の発行
        $result = $stmt->execute();

        // db挿入したらsession変数を空にする命令
        unset($_SESSION['join']);

        // db挿入ができたらthanks.phpにジャンプ
        header('Location: thanks.php');
        die();
    } catch (PDOException $e) {
        echo 'レコード挿入エラー：' . $e->getMessage();
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録確認</title>

    <link rel="stylesheet" href="../stylesheets/reset.css">
    <link rel="stylesheet" href="../stylesheets/base.css">
</head>

<body>
    <div class="wrap">
        <header>
            <h1>会員登録の確認</h1>
        </header>

        <main>
            <p>記入した内容を確認して、「登録する」ボタンをクリックしてください</p>

            <form action="" method="post">
                <input type="hidden" name="action" value="submit">
                <dl>
                    <div>
                        <dt>ニックネーム</dt>
                        <dd><?php echo h($_SESSION['join']['name']); ?></dd>
                    </div>

                    <div>
                        <dt>メールアドレス</dt>
                        <dd><?php echo h($_SESSION['join']['email']); ?></dd>
                    </div>

                    <div>
                        <dt>パスワード</dt>
                        <dd>【パスワードは表示されません】</dd>
                    </div>
                </dl>
                <div>
                    <a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> ｜ <input type="submit" value="登録する">
                </div>

            </form>
        </main>

        <footer id="footer" class="footer">
            <div class="footer__copy-right">
                <p><small>&copy; <span id="copyRight"></span> Hirotomo Ono</small></p>
            </div>
        </footer>
    </div>
</body>

</html>
