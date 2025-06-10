<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register2.css') }}" />
</head>
<body>
    <div class="form-container">
        <h1>PiGLy</h1>
        <h2>新規会員登録</h2>
        <p>STEP2 体重データの入力</p>
        <form>
            <label for="name">現在の体重</label>
            <input type="text" id="name" placeholder="現在の体重を入力">
            <label for="email">目標の体重</label>
            <input type="email" id="email" placeholder="目標の体重を入力">
            <button class="button" type="submit">次に進む</button>
        </form>
    </div>
</body>
</html>
