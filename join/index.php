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
$name_input = '';
$email_input = '';
$password_input = '';

//check.phpから戻ってきたときにSESSION['join']があればエスケープ処理を変数に代入して値を投入したまま返ってくる
// ニックネームの記入確認
if (isset($_POST['name'])) {
    $name_input = h($_POST['name']);
} else if (isset($_SESSION['join']['name'])) {
    $name_input = h($_SESSION['join']['name']);
}

//check.phpから戻ってきたときにSESSION['join']があればエスケープ処理を変数に代入して値を投入したまま返ってくる
// メールアドレスの記入確認
if (isset($_POST['email'])) {
    $email_input = h($_POST['email']);
} else if (isset($_SESSION['join']['email'])) {
    $email_input = h($_SESSION['join']['email']);
}

//check.phpから戻ってきたときにSESSION['join']があればエスケープ処理を変数に代入して値を投入したまま返ってくる
// パスワードの記入確認
if (isset($_POST['password'])) {
    $password_input = h($_POST['password']);
} else if (isset($_SESSION['join']['password'])) {
    $password_input = h($_SESSION['join']['password']);
}

// 各要素が空欄でないか確認する
if (!empty($_POST)) {
    // ニックネームが空欄であればerror配列name内にblankを代入する
    if ($_POST['name'] === '') {
        $error['name'] = 'blank';
    }

    // メールが空欄であればerror配列name内にblankを代入する
    if ($_POST['email'] === '') {
        $error['email'] = 'blank';
    }

    // パスワードの文字が4文字未満であればエラーを表示
    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }

    // パスワードが空欄であればerror配列name内にblankを代入する
    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }

    // 記入欄が空欄でなければメアドの重複がないか確認するsql文を準備して発行する
    if (empty($error)) {
        try {
            $sql = "SELECT COUNT(*) ";
            $sql .= "AS cnt ";
            $sql .= "FROM ";
            $sql .= "members ";
            $sql .= "WHERE ";
            $sql .= "email=?";

            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1, $email_input, PDO::PARAM_STR);
            $result = $stmt->execute();

            // sqlが正常に発行できたら値を$emailに代入
            if ($result) {
                $email = $stmt->fetch(PDO::FETCH_ASSOC);
                // レコード数をcntに格納しているので同じアドレスが存在する場合は、1を返す。0は存在しない正常。
                if ($email['cnt'] > 0) {
                    $error['email'] = 'duplicate';
                }
            }
        } catch (PDOException $e) {
            echo 'レコード検索エラー｜' . $e->getMessage();
            die();
        }
    }

    if (empty($error)) {
        $_SESSION['join'] = $_POST;
        header('Location: check.php');
        die();
    }
}

// check.phpからurlパラメータで返ってきたデータをindex.phpで利用できるように格納
// urlパラメーターにaction=rewriteがなければ変数に代入し、
// 値があれば$_SESSION情報を$_POSTに変換する
$check = '';
if (isset($_REQUEST['action'])) {
    $check = $_REQUEST['action'] == 'rewrite';
} else if (isset($check) && isset($_SESSION['join'])) {
    $_POST = $_SESSION['join'];
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>

    <link rel="stylesheet" href="../stylesheets/reset.css">
    <link rel="stylesheet" href="../stylesheets/base.css">
</head>

<body>
    <div class="wrap">
        <header>
            <h1>会員登録</h1>
        </header>

        <main>
            <p>※必要項目を入力し、会員登録を行ってください。</p>

            <form action="" method="post">
                <dl>
                    <div>
                        <dt>ニックネーム<span>必須</span></dt>
                        <dd>
                            <input type="text" name="name" id="name" maxlength="225" placeholder="ニックネームを入力" value="<?php echo $name_input; ?>">
                            <?php
                            if (isset($error['name']) && $error['name'] === 'blank') {
                                echo '<p class="error">*ニックネームを入力してください</p>';
                            }
                            ?>
                        </dd>
                    </div>

                    <div>
                        <dt>メールアドレス<span>必須</span></dt>
                        <dd>
                            <input type="text" name="email" id="name" maxlength="225" placeholder="aaa@aaa.com" value="<?php echo $email_input; ?>">
                            <?php
                            if (isset($error['email']) && $error['email'] === 'blank') {
                                echo '<p class="error">*メールアドレスを入力してください</p>';
                            }
                            ?>
                            <?php
                            if (isset($error['email']) && $error['email'] === 'duplicate') {
                                echo '<p class="error">*入力したメールアドレスは、既に登録されています。</p>';
                            }
                            ?>
                        </dd>
                    </div>

                    <div>
                        <dt>パスワード<span>必須</span></dt>
                        <dd>
                            <input type="text" name="password" id="name" maxlength="20" placeholder="４文字以上" value="<?php echo $password_input; ?>">
                            <?php
                            if (isset($error['password']) && $error['password'] === 'blank') {
                                echo '<p class="error">*パスワードを入力してください</p>';
                            }
                            if (isset($error['password']) && $error['password'] === 'length') {
                                echo '<p class="error">*パスワードは4文字以上で入力してください</p>';
                            }
                            ?>
                        </dd>
                    </div>
                </dl>
                <div>
                    <input type="submit" value="入力内容を確認する">
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
