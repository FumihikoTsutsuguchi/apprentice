<?php
    abstract class Pokemon
    {
        protected $name;
        protected $hp;
        protected $maxHp;
        protected $atk;

        abstract function attack_message($target);

        function attack($target) {
            $target->hp -= $this->atk;
            $target->hp = max(0, $target->hp);

            echo "{$this->name}の攻撃!";
            $this->attack_message($target);
        }

        function isFainted(){
            return $this->hp <= 0;
        }

        function getName() {
            return $this->name;
        }

        function getHp() {
            return $this->hp;
        }

        // function setHp($setHp) {
        //     if ($setHp < 0) {
        //         $this->hp = 0;
        //     } elseif ($setHp > $this->maxHp) {
        //         $this->hp = $this->maxHp;
        //     } else {
        //         $this->hp = $setHp;
        //     }
        // }

        function __construct($name, $hp, $atk) {
            $this->name = $name;
            $this->hp = $hp;
            $this->maxHp = $hp * 2;
            $this->atk = $atk;
        }
    }

    class Pikachu extends Pokemon
    {
        function __construct() {
            parent::__construct("ピカチュウ", 20, 10);
        }
        function attack_message($target) {
            echo "10万ボルト!{$target->name}は{$this->atk}ダメージををもらった！\n{$target->name}のHPは{$target->hp}だ！\n";
        }
    }

    class Hitokage extends Pokemon
    {
        function __construct() {
            parent::__construct("ヒトカゲ", 18, 5);
        }
        function attack_message($target) {
            echo "かえんほうしゃ!{$target->name}は{$this->atk}ダメージををもらった！\n{$target->name}のHPは{$target->hp}だ！\n";
        }
    }

    class Game
    {
        protected $pokemon1;
        protected $pokemon2;

        function __construct($pokemon1, $pokemon2){
            $this->pokemon1 = $pokemon1;
            $this->pokemon2 = $pokemon2;
        }
        function battle() {
            $this->start();
            list($winner, $loser) = $this->attack();
            $this->showResult($winner, $loser);

        }
        protected function start() {
            echo "{$this->pokemon1->getName()}が現れた！{$this->pokemon1->getName()}のHPは{$this->pokemon1->getHp()}だ！\n";
            echo "{$this->pokemon2->getName()}が現れた！{$this->pokemon2->getName()}のHPは{$this->pokemon2->getHp()}だ！\n";
        }
        protected function attack() {
            while (True) {
                $this->pokemon1->attack($this->pokemon2);
                if ($this->pokemon2->isFainted()) {
                    return [$this->pokemon1, $this->pokemon2];
                }
                $this->pokemon2->attack($this->pokemon1);
                if ($this->pokemon1->isFainted()) {
                    return [$this->pokemon2, $this->pokemon1];
                }
            }
        }
        protected function showResult($winner, $loser) {
            echo "{$loser->getName()}は倒れた。{$winner->getName()}のかち！\n";
        }
    }

    $pikachu = new Pikachu;
    $hitokage = new Hitokage;
    $game = new Game($pikachu, $hitokage);
    $game->battle();

?>
