<?php 

//A drink has a type (tea,coffee,chocolate) and a price for it 

namespace Pdpaola\CoffeeMachine\Console;

/**
 * This class represents a drink which has a type and a price 
 */

 class Drink{
    private string $type;
    private float $price;

    private static array $types = ['tea' => 0.4, 'coffee' => 0.5, 'chocolate' => 0.6 ];
    
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

    /**
     * Checks if the requested drink type is available or not 
     * @param string $type The type of the drink to check.
     * @return bool Returns true if the drink type is available, false otherwise.
     */

     public static function isAvailableDrinkType(string $type): bool{
        return isset(self::$types[strtolower($type)]);
     }
 }