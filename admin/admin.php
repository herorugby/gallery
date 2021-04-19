<?php


// セッションがあるかを判定してからスタートする
if (!isset($_SESSION)) {
    session_start();
}

// アカウント重複確認をするためにdbに接続する
require_once('../dbconnect.php');

// function関数のファイルを呼び出し
require_once('../myfunc.php');



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
                            <input type="file" name="image" id="image" value="">
                            <p>*.jpeg/.JPEG/.jpg?.jpgのみ</p>
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
