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
        <h1>タスクの追加</h1>

        <form action="/create" method="post">
            @csrf
            @if ($errors->any())
                <ul>
                @foreach ($errors->all() as $error)
                <li style="color:red">{{$error}}</li>
                @endforeach
                </ul>
            @endif
            <input type="text" name="title" placeholder="タスクを入力する">
            <input type="submit" name="create" value="保存する">
        </form>
    </div>
</body>
</html>
