<?php
namespace blackjack;

require_once "Autoloader.php";

class Deck //山札のデータを管理
{
    public array $cards = [];
    public function __construct()
    {
        $pictures = ["ハート", "スペード", "ダイヤ", "クローバー"];
        $numbers = ["A", 2, 3, 4, 5, 6, 7, 8, 9, 10 ,'J', "Q", "K"];

        foreach ($pictures as $picture) {
            foreach ($numbers as $number) {
                $this->cards[] = new Card($picture, $number);
            }
        }
    }
    // 山札のカードをシャッフル
    public function shuffleCard()
    {
        shuffle($this->cards);
    }
}
