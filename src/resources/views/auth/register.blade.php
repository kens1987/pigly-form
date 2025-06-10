<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録 | PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>
<body>
    <div class="form-container">
        <h1>PiGLy</h1>
        <h2>新規会員登録</h2>
        <p>STEP1 アカウント情報の登録</p>
        <form action="{{ route('register.step1') }}" method="post">
            @csrf
            <label for="name">お名前</label>
            <input type="text" name="name" placeholder="名前を入力">
                @error('name')
                <div class="error">{{ $message }}</div>
                @enderror
            <label for="email">メールアドレス</label>
            <input type="email" name="email" placeholder="メールアドレスを入力">
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
            <label for="password">パスワード</label>
            <input type="password" name="password" placeholder="パスワードを入力">
                @error('password')
                <div class="error">{{ $message }}</div>
                @enderror
            <button class="button" type="submit">次に進む</button>
        </form>
            <a class="login-link" href="/login">ログインはこちら</a>
    </div>
</body>
</html>
