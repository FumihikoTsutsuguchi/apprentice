<?php

namespace blackjack;

require_once "deck.php";
require_once "player.php";

class Dealer extends Player //CPUの手札・実行を管理
{
    public function play(Deck $deck)
    {
        echo "ディーラーの引いた2枚目のカードは{$this->cardsHave[1]->picture}の{$this->cardsHave[1]->number}です。" . PHP_EOL;

        $count = 2; //ディーラーの3枚目以降のカードをカウント

        while ($this->calculateNumber() < 17) {
            $score = $this->calculateNumber();
            echo "ディーラーの現在の得点は{$score}です。" .PHP_EOL;
            $this->drawCard($deck);
            echo "ディーラーの引いたカードは{$this->cardsHave[$count]->picture}の{$this->cardsHave[$count]->number}です。" . PHP_EOL;
            $count++;
        }
    }
}
