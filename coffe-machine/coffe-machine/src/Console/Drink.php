<?php 

//A drink has a type (tea,coffee,chocolate) and a price for it 

namespace Pdpaola\CoffeeMachine\Console;

/**
 * This class represents a drink which has a type and a price 
 */

 class Drink{
    private string $type;
    private float $price;
    
    /**
     * Constructor of the class Drink
     */

    public function __construct(string $type,float $price){
        $this->type = $type;
        $this->price = $price;
    }

    /**
     * Getters and Setters for the class drink
     */

    public function getType(): string{
        return $this->type;
    }

    public function getPrice(){
        return $this->price;
    }
 }