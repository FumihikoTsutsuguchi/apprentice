<?php

function calculate(int $num1, int $num2, string $operator)
{
    if (!is_int($num1) || !is_int($num2)) {
        throw new Exception("num1、 num2 には整数を入力してください");
    }
    if (!in_array($operator, ['+','-','*','/'], true)) {
        throw new Exception("演算子には  +、-、*、/ のいずれかを使用してください");
    }
    if ($operator === '/' && $num2 ===0) {
        throw new Exception("ゼロによる割り算は許可されていません");
    }

    switch ($operator) {
        case '+':
            return $num1 + $num2;
            break;
        case '-':
            return $num1 - $num2;
            break;
        case '*':
            return $num1 * $num2;
            break;
        case '/':
            return $num1 / $num2;
    }
}
echo "1番目の整数を入力してください:" . PHP_EOL;
$num1 = trim(fgets(STDIN));

echo "2番目の整数を入力してください:" . PHP_EOL;
$num2 = trim(fgets(STDIN));

echo "演算子(+, -, *, /)を入力してください:" . PHP_EOL;
$operator = trim(fgets(STDIN));

try {
    $result = calculate($num1, $num2, $operator);
    echo $result . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
