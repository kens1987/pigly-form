<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>体重ログの編集</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
    <div class="container">
        <h1>体重ログの編集</h1>
        <form action="{{ route('data.update', ['weightLogId' => $weightLog->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="weight">体重 (kg)</label>
                <input type="number" name="weight" id="weight" value="{{ old('weight', $weightLog->weight) }}" required>
            </div>
            <div class="form-group">
                <label for="calories">摂取カロリー</label>
                <input type="number" name="calories" id="calories" value="{{ old('calories', $weightLog->calories) }}" required>
            </div>
            <div class="form-group">
                <label for="exercise_time">運動時間 (分)</label>
                <input type="number" name="exercise_time" id="exercise_time" value="{{ old('exercise_time', $weightLog->exercise_time) }}" required>
            </div>
            <div class="form-group">
                <label for="date">日付</label>
                <input type="date" name="date" id="date" value="{{ old('date', $weightLog->date) }}" required>
            </div>
            <a href="{{ route('weight_logs.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn">更新する</button>
        </form>
    </div>
</body>
</html>
