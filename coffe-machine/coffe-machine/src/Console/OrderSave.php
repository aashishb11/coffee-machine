<?php

namespace Pdpaola\CoffeeMachine\Console;

use Pdpaola\CoffeeMachine\Console\Order;

/**
 * This class implements the logic of saving the data of each drink
 * how many drinks has been purchased and the total money earned from each drink
 */

 class OrderSave{

    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function save(Order $order) : void 
    {
        //Insertion and execution 

        $stmt = $this->pdo->prepare(
            'INSERT INTO orders (drink_type, sugars, stick, extra_hot) VALUES (:drink_type, :sugars, :stick, :extra_hot)'
        );
        $stmt->execute([
            'drink_type' => $order->getDrink()->getType(),
            'sugars' => $order->getSugars(),
            'stick' => $order->hasStick() ? 1 : 0,
            'extra_hot' => $order->isExtraHot() ? 1 : 0,
        ]);
    }
 }