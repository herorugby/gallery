<?php

// セッションがあるかを判定してからスタートする
if (!isset($_SESSION)) {
    session_start();
}

// アカウント重複確認をするためにdbに接続する
require_once('../dbconnect.php');

// function関数のファイルを呼び出し
require_once('../myfunc.php');

// 各記入蘭に空要素がないか確認するために空の変数を用意
$email_input = '';
$password_input = '';

// メールアドレスの記入確認
if (isset($_POST['email'])) {
    $email_input = h($_POST['email']);
}

// パスワードの記入確認
if (isset($_POST['password'])) {
    $password_input = h($_POST['password']);
}

if (!empty($_POST)) {

    // パスワードなどを間違えても入力したアドレスが入力されたままにする。
    $email_input = h($_POST['email']);

    if ($email_input !== '' && $password_input !== '') {
        try {
            // memebersテーブルの登録内容を確認する
            $sql = "SELECT * FROM ";
            $sql .= "members ";
            $sql .= "WHERE ";
            $sql .= "email=? ";
            $sql .= "AND ";
            $sql .= "password=?";

            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1, $email_input, PDO::PARAM_STR);
            $stmt->bindValue(2, sha1($password_input), PDO::PARAM_STR);
            $result = $stmt->execute();

            // 取得したデータを変数に代入
            if ($result) {
                $administrator = $stmt->fetch(PDO::FETCH_ASSOC);

                // データが変数に代入できていれば判定を行う
                if ($administrator) {
                    if ($administrator['email'] == $email_input && $administrator['password'] == sha1($password_input)) {
                        // ここでデータをセッションに代入する
                        $_SESSION['email'] = $administrator['email'];
                        // admin.phpでは下のセッションは利用していない
                        $_SESSION['password'] = $administrator['password'];
                        header('Location: admin.php');
                        die();
                    }
                } else {
                    $error['login'] = 'failed';
                }
            }
        } catch (PDOException $e) {
            echo 'レコード取得エラー｜' . $e->getMessage();
            die();
        }
    } else {
        $error['login'] = 'blank';
    }

    if (empty($error)) {
        $_SESSION['join'] = $_POST;
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
    <title>ログインページ</title>

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="base.css">
</head>

<body>
    <div class="wrap">
        <header>
            <h1>ログインする</h1>
        </header>

        <main>
            <section>
                <h2>メールアドレスとパスワードを記入してログインしてください。</h2>
                <p>入会手続きがまだの方はこちらからどうぞ。</p>
                <p>&raquo;<a href="join/">入会手続きをする</a></p>
            </section>

            <form action="" method="post">

                <div>
                    <label for="email">メールアドレス</label>
                    <input type="text" name="email" id="name" maxlength="225" placeholder="aaa@aaa.com" value="">
                </div>

                <div>
                    <label for="password">パスワード</label>
                    <input type="text" name="password" id="name" maxlength="20" placeholder="abcd" value="">
                </div>

                <div>
                    <p>ログイン情報の記録</p>
                    <input id="save" type="checkbox" name="save" value="on">
                    <label for="save">次回からは自動的にログインする</label>
                </div>

                <div>
                    <input type="submit" value="ログインする">
                    <p>*メールアドレスとパスワードを入力してください</p>
                    <p>*ログインに失敗しました。正しく入力してください。</p>
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
