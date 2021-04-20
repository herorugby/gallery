<?php

// セッションがあるかを判定してからスタートする
if (!isset($_SESSION)) {
    session_start();
}

// アカウント重複確認をするためにdbに接続する
require_once('../dbconnect.php');

// function関数のファイルを呼び出し
require_once('../myfunc.php');

// 前ページでセッションに保存されていなければ強制的にindexに戻す
// if (!isset($_SESSION['join'])) {
//     header('Location: index.php');
//     die();
// }

// dbテーブル内のdatetime取得のため変数を用意
$date = new DateTime();
$date = $date->format('Y-m-d H:i:s');

// 登録ボタンを押したらデータをdbに挿入する
if (!empty($_POST)) {
    try {
        // 挿入するsql文準備
        $sql = "INSERT INTO ";
        $sql .= "picture ";
        $sql .= "(picture, created) ";
        $sql .= "VALUES ";
        $sql .= "(?, ?) ";

        // sql文の準備
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(1, $_SESSION['join']['image'], PDO::PARAM_STR);
        $stmt->bindValue(2, $date, PDO::PARAM_STR);

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
    <title>画像確認</title>

    <link rel="stylesheet" href="../stylesheets/reset.css">
    <link rel="stylesheet" href="../stylesheets/base.css">
</head>

<body>
    <div class="wrap">
        <header>
            <h1>画像の確認</h1>
        </header>

        <main>
            <p>内容を確認して、「登録する」ボタンをクリック</p>

            <form action="" method="post">
                <input type="hidden" name="action" value="submit">
                <dl>
                    <div>
                        <dt>写真</dt>
                        <dd>
                            <?php
                            if ($_SESSION['join']['image'] != '') {
                                echo '<img src="../my_gallery/' . h($_SESSION['join']['image']) . '">';
                            }
                            ?>
                        </dd>
                    </div>
                </dl>
                <div>
                    <input type="submit" value="登録する">
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
