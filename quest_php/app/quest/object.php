<?php
    class VendingMachine
    {
        protected $makerName;
        protected $totalCoin; // 投入された金額の合計
        protected $cupStock;  // カップの在庫

        function __construct($makerName)
        {
            $this->makerName = $makerName;
            $this->totalCoin = 0;
        }

        private function pressManufacturerName()
        {
            return $this->makerName . "\n";
        }

        function pressButton(Item $item)
        {
            if ($item->canPurchase($this->totalCoin, $this->cupStock)) {
                $this->totalCoin -= $item->getPrice();
                if ($item instanceof CupCoffee) {
                    $this->cupStock--;
                }
                return $item->getDescription() . "\n";
            } else {
                return "\n";
            }
        }

        function depositCoin(int $coin)
        {
            if ($coin === 100) {
                $this->totalCoin += $coin;
            }
        }
        public function addCup($count)
        {
            $this->cupStock += $count;
            // 最大在庫数を超えないように制限
            $this->cupStock = min($this->cupStock, 100);
        }
    }

    abstract class Item
    {
        protected $name;
        protected $price;

        public function __construct($name, $price)
        {
            $this->name = $name;
            $this->price = $price;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getPrice()
        {
            return $this->price;
        }

        abstract public function getDescription();

        abstract public function canPurchase($totalCoin, $cupStock);
    }

    class Drink extends Item
    {
        public function __construct($name)
        {
            parent::__construct($name, ($name === 'cider') ? 100 : 150);
        }
        public function getDescription()
        {
            return $this->getName();
        }
        public function canPurchase($totalCoin, $cupStock)
        {
            return $totalCoin >= $this->getPrice();
        }
    }

    class CupCoffee extends Item
    {
        protected $type;

        public function __construct($type)
        {
            parent::__construct('cup coffee', 100);
            $this->type = $type;
        }

        public function getDescription()
        {
            return $this->type . ' ' . $this->getName();
        }
        public function canPurchase($totalCoin, $cupStock)
        {
            return $totalCoin >= $this->getPrice() && $cupStock > 0;
        }
    }

    class Snack extends Item
    {
         public function __construct()
        {
            parent::__construct('potato chips', 100);
        }
        public function getDescription()
        {
            return $this->getName();
        }
        public function canPurchase($totalCoin, $cupStock)
        {
            return $totalCoin >= $this->getPrice();
        }
    }


    $hotCupCoffee = new CupCoffee('hot');
    $cider = new Drink('cider');
    $snack = new Snack();
    $vendingMachine = new VendingMachine('サントリー');
    $vendingMachine->depositCoin(100);
    $vendingMachine->depositCoin(100);
    echo $vendingMachine->pressButton($cider);

    echo $vendingMachine->pressButton($hotCupCoffee);
    $vendingMachine->addCup(1);
    echo $vendingMachine->pressButton($hotCupCoffee);

    echo $vendingMachine->pressButton($snack);
    $vendingMachine->depositCoin(100);


   ?>
