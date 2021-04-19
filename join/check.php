<?php

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
                        <dd>にーーーっくねーむ</dd>
                    </div>

                    <div>
                        <dt>メールアドレス</dt>
                        <dd>aaa@aaa.com</dd>
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
