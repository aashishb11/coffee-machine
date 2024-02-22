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
    }
 }