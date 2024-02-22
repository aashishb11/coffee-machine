<?php

namespace Pdpaola\CoffeeMachine\Console;

use Pdpaola\CoffeeMachine\Console\Drink;

/**
 * This class includes the validation logic asked, it validates the details of an order.
 */

 class OrderValidator{

    /**
     * It checks if the provided drink type is valid or not 
     */

     public static function validateDrinkType(string $type): bool{
        return Drink::isAvailableDrinkType($type); //I need to create this function in Drink class 
     } 

     /**
      * Validates if the provided money is enough for the drink requested or not 
      */

     public static function validateMoney(float $money, Drink $drink): bool{
        return $money > $drink->getPrice();
     }

     /**
      * Validates the number of sugars in the order. 
      */

     public static function validateSugars(int $sugars): bool{
        return $sugars >= 0 && $sugars <= 2;
     }
 }