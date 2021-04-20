<?php

// セッションがあるかを判定してからスタートする
if (!isset($_SESSION)) {
    session_start();
}

// アカウント重複確認をするためにdbに接続する
require_once('../dbconnect.php');

// function関数のファイルを呼び出し
require_once('../myfunc.php');

// ファイルの確認
$fileName = '';
if (isset($_FILES['image'])) {
    $fileName = h($_FILES['image']['name']);
}

// ファイルの拡張子extensionを確認するエラーチェック
if (!empty($fileName)) {
    // ファイル名の後ろ３文字を切り取る。substr
    $ext = substr($fileName, -3);
    if ($ext != 'jpg' && $ext != 'JPG') {
        $error['image'] = 'type';
    }

    // 入力値に問題がなけれな処理を走らせる
    if (empty($error)) {
        // ファイルをアップロードした時間を取得し、ファイル名と連結する
        $image = date('YmdHis') . h($_FILES['image']['name']);
        // 第一引数でファイルを一時的に保存する。第二引数でそれらを指定したフォルダに移動する。
        move_uploaded_file($_FILES['image']['tmp_name'], '../my_gallery/' . $image);
        // エラーがなければjoinにPOSTの内容を保存する。これでcheck.phpで値を参照できる
        $_SESSION['join'] = $_POST;
        $_SESSION['join']['image'] = $image;
        header('Location: check.php');
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
    <title>管理者</title>

    <link rel="stylesheet" href="../stylesheets/reset.css">
    <link rel="stylesheet" href="../stylesheets/base.css">
</head>

<body>
    <div class="wrap">
        <header>
            <h1>管理者ページ</h1>
        </header>

        <main>
            <p>写真を登録</p>

            <form action="" method="post" enctype="multipart/form-data">
                <dl>
                    <div>
                        <dt>画像<span>必須</span></dt>
                        <dd>
                            <input type="file" name="image" size="35" value="test">
                            <?php
                            if (isset($error['image']) && $error['image'] === 'type') {
                                echo '<p class="error">*写真の拡張子は、.jpg/.jpeg/.JPG/.JPEGとなります。</p>';
                            }
                            ?>
                        </dd>
                    </div>
                </dl>
                <div>
                    <input type="submit" value="確認">
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
