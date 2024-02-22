<?php

/**
 * This class implements the logic of ordering a drink from a machine
 * A drink can or cannot have sugar in it 
 * A drink can be extrahot or not 
 * If a drink has a valid number of sugar then it has a stick
 */

 namespace Pdpaola\CoffeeMachine\Console;

 class Order{

    private Drink $drink; //a drink associated with a specific order

    private int $sugars;

    private bool $extraHot;

    private bool $stick; //If a drink has a valid number of sugar then it has a stick

    /**
     * Constructor of the class.
     */

    public function __construct(Drink $drink, int $sugars, bool $extraHot){
        $this->drink = $drink;  
        $this->sugars = $sugars;
        $this->extraHot = $extraHot;
        $this->stick = $sugars > 0;

    }

    /**
     * Getters of the class Order
     */

    public function getDrink(): Drink{
        return $this->drink;
    }

    public function getSugars(): int{
        return $this->sugars;
    }

    public function isExtraHot(): bool{
        return $this->extraHot;
    }

    public function hasStick(): int{
        return $this->stick;
    }


 }