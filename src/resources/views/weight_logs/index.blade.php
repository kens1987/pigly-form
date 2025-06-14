<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>体重管理画面 | PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
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
    <main class="dashboard-main">
        <div class="summary-box">
            <div class="summary-item">
                <p>目標体重</p>
                <h2>{{ $weightTarget->target_weight ?? '-' }} <span>kg</span></h2>
            </div>
            <div class="summary-item">
                <p>目標まで</p>
                <h2>
                    @if(!is_null($diff))
                    {{ number_format($diff,1) }}
                    @else
                    -
                    @endif
                    <span>kg</span>
                </h2>
            </div>
            <div class="summary-item">
                <p>最新体重</p>
                <h2>{{ $latestWeightLog->weight ?? '-' }}<span>kg</span></h2>
            </div>
        </div>
        <div class="search-add-section">
            <form class="search-form" action="{{ route('weight_logs.index') }}" method="get">
                <input type="date" name="form" value="{{ request('form') }}">
                <span>〜</span>
                <input type="date" name="to" value="{{ request('to') }}">
                <button class="btn-search">検索</button>
                @if (request('form')&&request('to'))
                <a href="{{ route('weight_logs.index') }}" class="btn-reset">リセット</a>
                @endif
            </form>
            <button id="openModal" class="btn-add">データ追加</button>
        </div>
        <div id="modal" class="modal" style="display:none;">
            <div class="modal-content">
                <span id="closeModal" class="close">&times;</span>
                <form action="{{ route('data.store') }}" method="post">
                    @csrf
                    <label>日付  <span>必須</span></label>
                    <input type="date" name="date">
                    @error('date')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <label>体重  <span>必須</span></label>
                    <input type="number" step="0.1" name="weight">
                    @error('weight')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <label>摂取カロリー  <span>必須</span></label>
                    <input type="number" name="calories">
                    @error('calories')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <label>運動時間  <span>必須</span></label>
                    <input type="number" name="exercise_time">
                    @error('exercise_time')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <button type="submit">登録</button>
                </form>
            </div>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($record->date)->format('Y/m/d') }}</td>
                    <td>{{ number_format($record->weight,1) }}kg</td>
                    <td>{{ number_format($record->calories) }}cal</td>
                    <td>
                        @php
                        $hours = floor($record->exercise_time / 60);
                        $minutes = $record->exercise_time % 60;
                        @endphp
                        {{ $hours }}時間{{ $minutes }}分
                    </td>
                    <td><a href="{{ route('data.edit', ['weightLogId' => $record->id]) }}" class="edit-icon">✏️</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $records->links() }}
        </div>
    </main>
    </div>
    <script>
        const modal =document.getElementById('modal');
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');
        openModal.addEventListener('click',() => {
            modal.style.display = 'block';
        });
        closeModal.addEventListener('click',() => {
            modal.style.display = 'block';
        });
        window.addEventListener('click',(e) => {
            if (e.target == modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>
</html>
