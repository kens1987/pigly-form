<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>目標体重変更画面 | PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}" />
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1 class="logo">PiGLy</h1>
            <div class="header-right">
                <a href="{{ route('goal.setting') }}" class="btn-setting">目標体重設定</a>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">ログアウト</button>
                </form>
            </div>
        </header>
        <main>
            <div class="goal-setting-box">
                <h2>目標体重設定</h2>
                <form action="{{ route('goal.setting.update') }}" method="post">
                    @csrf
                    <input type="number" step="0.1" name="target_weight" value="{{ old('target_weight',$weightTarget->target_weight ?? '') }}" >
                    <span class="unit">kg</span>
                    @error('target_weight')
                    <div class="error"></div>
                    @enderror
                    <div class="btn-group">
                        <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>
                        <button type="submit" class="btn-update">更新</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
