<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>タスクの編集</h1>

        <form action="/edit" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$todo->id}}">
            <input type="text" name="title" placeholder="タスクを入力する" value="{{$todo->title}}">
            <input type="submit" name="edit" value="保存する">
        </form>
    </div>
</body>
</html>
