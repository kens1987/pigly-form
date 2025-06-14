<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録 | PIGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register2.css') }}" />
</head>
<body>
    <div class="form-container">
        <h1>PiGLy</h1>
        <h2>新規会員登録</h2>
        <p>STEP2 体重データの入力</p>
        <form action="{{ route('register.step2.submit') }}" method="post">
            @csrf
            <label for="weight">現在の体重</label>
            <input type="number" name="weight" placeholder="現在の体重を入力">
            @error('weight')
                <div class="error">{{ $message }}</div>
            @enderror
            <label for="target_weight">目標の体重</label>
            <input type="number" name="target_weight" placeholder="目標の体重を入力">
            @error('target_weight')
                <div class="error">{{ $message }}</div>
            @enderror
            <button class="button" type="submit">アカウント作成</button>
        </form>
    </div>
</body>
</html>
