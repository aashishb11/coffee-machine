<?php

namespace Pdpaola\CoffeeMachine\Console;

use Pdpaola\CoffeeMachine\Console\Order;
use Symfony\Component\Console\Output\OutputInterface;
/**
 * This class implements the logic of handling the process of making the drink and showing output if the asked drink
 * is correct.
 */

 class DrinkMaker
 {

    /**
     * Constructs and sends the order message to the terminal
     */
    public function makeDrink(Order $order, OutputInterface $output): void
    {
       $drinkDetails = $this->getDrinkDetails($order);
       $output ->writeln($drinkDetails);
    }

    /**
     * Generates the details of the order 
     */

     private function getDrinkDetails(Order $order): string{

        $details = ['You have ordered a ' . $order->getDrink()->getType()];

        if ($order->isExtraHot()) {
            $details .= ' extra hot';
        }

        if ($order->getSugars() > 0) {
            $details .= sprintf(' with %d sugars (stick included)', $order->getSugars());
        }

        return $details;
     }

 }

