<?php
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
