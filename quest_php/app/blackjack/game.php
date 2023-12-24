<?php
namespace blackjack;

require_once "Autoloader.php";

class Game //ゲームの進行を管理
{
    private Player $player;
    private Deck $deck;
    private Dealer $dealer;

    public function __construct()
    {
        $this->player = new Player();
        $this->dealer = new Dealer();
        $this->deck = new Deck();
    }
    // ブラックジャックゲームを開始
    public function start()
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;

        // 山札をシャッフル
        $this->deck->shuffleCard();
        // カードの配布
        $this->player->drawCard($this->deck);
        $this->player->drawCard($this->deck);
        $this->dealer->drawCard($this->deck);
        $this->dealer->drawCard($this->deck);
        // あなたとディーラーが最初に引いたカードを提示
        $this->showPlayerCard();
        $this->showDealerCard();
        // あなたのターン
        $this->askDrawCard();
        // ディーラーのターン
        $this->dealer->play($this->deck);
        // 結果を表示
        $this->showResult();
    }

    private function showPlayerCard()
    {
        echo "あなたの引いたカードは" .
        "{$this->player->cardsHave[0]->picture}の{$this->player->cardsHave[0]->number}です。" . PHP_EOL;
        echo "あなたの引いたカードは" .
        "{$this->player->cardsHave[1]->picture}の{$this->player->cardsHave[1]->number}です。" . PHP_EOL;
    }

    private function showDealerCard()
    {
        echo "ディーラーの引いたカードは" .
        "{$this->dealer->cardsHave[0]->picture}の{$this->dealer->cardsHave[0]->number}です。" . PHP_EOL;
        echo "ディーラーの引いた2枚目のカードはわかりません。" . PHP_EOL;
    }

    private function askDrawCard()
    {
        while (true) {
            $score = $this->player->calculateNumber();
            if ($score > 21) {
                exit("バーストしました。あなたの負けです。") . PHP_EOL;
            }
            echo "あなたの現在の得点は{$score}です。カードを引きますか？(Y/N)" . PHP_EOL;
            $input = strtoupper(trim(fgets(STDIN)));

            if ($input == "Y") {
                $this->player->drawCard($this->deck);
                $count = count($this->player->cardsHave);

                echo "あなたの引いたカードは" .
                "{$this->player->cardsHave[$count - 1]->picture}の{$this->player->cardsHave[$count - 1]->number}です。" . PHP_EOL;
            } elseif ($input == "N") {
                break;
            }
        }
    }

    private function showResult()
    {
        $playerScore = $this->player->calculateNumber();
        $dealerScore = $this->dealer->calculateNumber();
        echo "あなたの得点は{$playerScore}です。" . PHP_EOL;
        echo "ディーラーの得点は{$dealerScore}です。" . PHP_EOL;

        if ($dealerScore > 21) {
            echo "あなたの勝ちです！" . PHP_EOL;
        } elseif ($dealerScore < $playerScore) {
            echo "あなたの勝ちです!" . PHP_EOL;
        } elseif ($dealerScore > $playerScore) {
            echo "あなたの負けです。" . PHP_EOL;
        } else {
            echo "引き分けです。" . PHP_EOL;
        }

        echo "ブラックジャックを終了します。" . PHP_EOL;
    }
}
