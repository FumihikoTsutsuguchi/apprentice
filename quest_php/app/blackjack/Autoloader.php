<?php
spl_autoload_register(function(string $class) : void {
    // 名前空間とクラス名を分割
    $parts = explode('\\', $class);
    // ファイル名はクラス名と同じになる
    $filename = end($parts) . '.php';
    // ファイルを読み込む
    require_once $filename;
});
