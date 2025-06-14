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
            <a href="{{ route('admin') }}" class="btn-setting">目標体重設定</a>
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
            <a href="{{ route('data.add') }}" class="btn-add">データ追加</a>
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
                    <td><a href="{{ route('data.edit', $record->id) }}" class="edit-icon">✏️</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $records->links() }}
        </div>
    </main>
    </div>
</body>
</html>
