<!DOCTYPE html>
<html lang="ja">
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン | PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>
<div class="form-container">
    <h1>PiGLy</h1>
    <h2>ログイン</h2>
    <form>
        <label for="email">メールアドレス</label>
        <input type="email" id="email" placeholder="名前を入力">
        <label for="password">パスワード</label>
        <input type="password" id="password" placeholder="名前を入力">
        <button class="button" type="submit">ログイン</button>
    </form>
    <a class="account-link" href="/register/step1">アカウント作成はこちら</a>
</div>
</body>
</html>
