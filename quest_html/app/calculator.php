<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>電卓アプリ</title>
    <style>#calculator{width:200px;margin:auto;text-align:center}#display{height:50px;line-height:50px;border:1px solid #000;margin-bottom:10px;font-size:24px}#buttons{display:grid;grid-template-columns:repeat(4,1fr)}button{height:50px;font-size:20px}</style>
</head>

<body>
    <div id="calculator">
        <div id="display"></div>
        <div id="buttons">
            <button class="digit">1</button>
            <button class="digit">2</button>
            <button class="digit">3</button>
            <button class="operator">+</button>
            <button class="digit">4</button>
            <button class="digit">5</button>
            <button class="digit">6</button>
            <button class="operator">-</button>
            <button class="digit">7</button>
            <button class="digit">8</button>
            <button class="digit">9</button>
            <button class="operator">*</button>
            <button class="digit">0</button>
            <button id="clear">C</button>
            <button class="operator">/</button>
            <button id="equals">=</button>
        </div>
    </div>
    <script src="js/calculator.js"></script>
</body>

</html>
