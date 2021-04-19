<?php

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
                            <input type="text" name="name" id="name" maxlength="225" placeholder="ニックネームを入力" value="">
                            <p>*ニックネームを入力してください</p>
                        </dd>
                    </div>

                    <div>
                        <dt>メールアドレス<span>必須</span></dt>
                        <dd>
                            <input type="text" name="email" id="name" maxlength="225" placeholder="aaa@aaa.com" value="">
                            <p>*メールアドレスを入力してください</p>
                            <p>*入力されたメールアドレスは、既に登録されたメールアドレスです。</p>
                        </dd>
                    </div>

                    <div>
                        <dt>パスワード<span>必須</span></dt>
                        <dd>
                            <input type="text" name="password" id="name" maxlength="20" placeholder="４文字以上" value="">
                            <p>*パスワードを入力してください</p>
                            <p>*パスワードは、４文字以上でお願いします。</p>
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
