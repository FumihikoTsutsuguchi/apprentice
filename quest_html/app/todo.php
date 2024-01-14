<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo</title>
    <!-- <link rel="stylesheet" type="text/css" href="dist/css/style.css"> -->
    <style>
        body{background-color:#f4f4f4}.todo-app{width:25pc;margin:0 auto;background-color:#fff;box-shadow:0 0 10px rgba(0,0,0,.1);padding:20px;border-radius:8px}h1{text-align:center}form{display:flex;margin-bottom:20px}#todo-input{flex-grow:1;padding:10px;border:1px solid #ddd;border-radius:4px}#add-button{padding:10px 20px;border:0;background-color:#007bff;color:#fff;cursor:pointer;margin-left:10px;border-radius:4px}#add-button:hover{background-color:#0056b3}#todo-list{list-style-type:none;padding:0}.todo-item{display:flex;justify-content:space-between;align-items:center;padding:10px;margin-bottom:10px;background-color:#f2f2f2;border-radius:4px}.delete-button{padding:5px 10px;border:0;background-color:#ff4d4d;color:#fff;cursor:pointer;border-radius:4px}.delete-button:hover{background-color:#c00}.text-line{text-decoration: line-through;}
    </style>
</head>

<body>
    <div class="todo-app">
        <h1>Todoリスト</h1>
        <form>
            <input type="text" id="todo-input" placeholder="新しいタスクを入力" />
            <button type="submit" id="add-button">タスクを追加する</button>
        </form>
        <ul id="todo-list">
            <!-- <li class="todo-item">
                <input type="checkbox"><span>TODO</span><button class="delete-button">削除</button>
            </li> -->
        </ul>
    </div>
    <script src="js/todo.js"></script>
</body>


</html>
