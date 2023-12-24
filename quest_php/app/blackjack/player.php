<?php

namespace blackjack;

require_once "deck.php";

class Player //実行者の手札・実行を管理
{
    public array $cardsHave = [];
    // カードを一枚引く
    public function drawCard(Deck $deck)
    {
        $this->cardsHave[] = array_pop($deck->cards);
    }
    // 現在のスコアを計算
    public function calculateNumber()
    {
        $score = 0;
        $numAces = 0;

        foreach ($this->cardsHave as $card) {
            switch ($card->number) {
                case 'A':
                    $score += 11;
                    $numAces++;
                    break;
                case 'J':
                case 'Q':
                case 'K':
                    $score += 10;
                    break;
                default:
                    $score += $card->number;
                    break;
            }
        }
        // Aを引いた際はスコア11としてカウント、手札の合計が21を超える場合は1としてカウント
        while ($score > 21 && $numAces > 0) {
            $score -= 10;
            $numAces--;
        }
        return $score;
    }
}
