<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <h1>Todo List</h1>

        <a class="new-task" href="/create-page">タスクを追加する</a>

        <table>
            <thead>
            <tr>
                <th>タスク</th>
                <th>アクション</th>
            </tr>
            </thead>
            <tbody>
                <!-- ここは後から動的コンテンツに置き換える -->
                @foreach($todos as $todo)
                <tr>
                    <td>{{$todo->title}}</td>
                    <td>
                    <a class="edit" href="/edit-page/{{$todo->id}}">編集</a>
                    <form method="post" action="/delete/{{$todo->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete" onclick="return confirm('本当に削除していいですか?')">削除</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

