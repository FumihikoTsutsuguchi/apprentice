<?php
namespace blackjack;

class Card //1枚のカードを管理
{
    public string $picture;
    public mixed $number;

    public function __construct(string $picture, mixed $number)
    {
        $this->picture = $picture;
        $this->number = $number;
    }
}
