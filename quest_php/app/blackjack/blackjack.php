
<?php
    class Card //1枚のカードを管理
    {
        // カード1枚を管理
        public string $picture;
        public mixed $number;

        function __construct(string $picture, mixed $number)
        {
            $this->picture = $picture;
            $this->number = $number;
        }

    }
    class Deck //山札のデータを管理
    {
        public array $cards = [];
        function __construct()
        {
            $pictures = ["ハート", "スペード", "ダイヤ", "クローバー"];
            $numbers = ["A", 2, 3, 4, 5, 6, 7, 8, 9, 10 ,'J', "Q", "K"];

            foreach ($pictures as $picture) {
                foreach ($numbers as $number) {
                    $this->cards[] = new Card($picture, $number);
                }
            }
        }
        // 山札のカードを保持
        public function shuffleCard()
        {
            shuffle($this->cards);
        }
        // 配られたカードは山札から削除
    }
    class Player //実行者の手札・実行を管理
    {
        public array $cardsHave = [];

        public function drawCard(Deck $deck)
        {
            $this->cardsHave[] = array_pop($deck->cards);
            // return $this->cardsHave;
        }

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

            while ($score > 21 && $numAces > 0) {
                $score -= 10;
                $numAces--;
            }

            return $score;
        }

        // 最初に配られたカードの合計を出力
        // カードを引くかどうか判定
        // 21を超えたら終了するよう判定
    }
    class Dealer extends Player//CPUの手札・実行を管理
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
        // 最初に配られたカードの合計を出力
        // 合計値が17以上になるまで引き続ける
        // 21を超えたら終了するように判定
    }
    class Game //ゲームの進行を管理
    {

        private Player $player;
        private Deck $deck;
        private Dealer $dealer;

        function __construct()
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

            $this->showResult();
        }

        public function showPlayerCard()
        {
            echo "あなたの引いたカードは{$this->player->cardsHave[0]->picture}の{$this->player->cardsHave[0]->number}です。" . PHP_EOL;
            echo "あなたの引いたカードは{$this->player->cardsHave[1]->picture}の{$this->player->cardsHave[1]->number}です。" . PHP_EOL;
        }

        public function showDealerCard()
        {
            echo "ディーラーの引いたカードは{$this->dealer->cardsHave[0]->picture}の{$this->dealer->cardsHave[0]->number}です。" . PHP_EOL;
            echo "ディーラーの引いた2枚目のカードはわかりません。" . PHP_EOL;
        }

        public function askDrawCard()
        {
            while (true) {
                $score = $this->player->calculateNumber();
                if ($score > 21) {
                    exit ("バーストしました。あなたの負けです。") . PHP_EOL;
                }
                echo "あなたの現在の得点は{$score}です。カードを引きますか？(Y/N)" . PHP_EOL;
                $input = strtoupper(trim(fgets(STDIN)));

                if ($input == "Y") {
                    $this->player->drawCard($this->deck);
                    $count = count($this->player->cardsHave);

                    echo "あなたの引いたカードは{$this->player->cardsHave[$count - 1]->picture}の{$this->player->cardsHave[$count - 1]->number}です。" . PHP_EOL;
                } elseif ($input == "N" ) {
                    break;
                }
            }
        }
        public function showResult()
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

        // ディーラーとプレイヤーに2枚ずつカードを配る
        // 結果を表示する(どちらが21に近い数字か判定 21を超えていたら失格)
        // ブラックジャックゲーム終了
    }

    $game = new Game;
    $game->start();

?>
