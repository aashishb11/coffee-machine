<?php

namespace Pdpaola\CoffeeMachine\Console;

use Pdpaola\CoffeeMachine\Console\DrinkMaker;
use Pdpaola\CoffeeMachine\Console\OrderValidator;
use Pdpaola\CoffeeMachine\Console\Drink;
use Pdpaola\CoffeeMachine\Console\Order;
use Pdpaola\CoffeeMachine\Console\OrderSave;
use Pdpaola\CoffeeMachine\Console\MysqlPdoClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';

    protected function configure()
    {
        $this
            ->addArgument('drink-type', InputArgument::REQUIRED,'The type of the drink. (Tea, Coffee, or Chocolate)')
            ->addArgument('money', InputArgument::REQUIRED,'The amount of money given by the user')
            ->addArgument('sugars', InputArgument::OPTIONAL,'The number of sugars you want. (0, 1, 2)', 0)
            ->addOption('extra-hot', 'e', InputOption::VALUE_NONE,'If the user wants to make the drink extra hot');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $drinkType = $input->getArgument('drink-type');
        $money = (float) $input->getArgument('money');
        $sugars = (int) $input->getArgument('sugars');
        $extraHot = $input->getOption('extra-hot');

        //validate drink type 
        if (!OrderValidator::validateDrinkType($drinkType)) {
            $output->writeln('The drink type should be tea, coffee or chocolate.');
            return Command::FAILURE;
        }

        //validate money 

        if (!OrderValidator::validateMoney($money, $drinkType)) {
            $output->writeln("The $drinkType costs {$drinkType->getPrice()}.");
            return Command::FAILURE;
        }

        //validate sugars 
        if (!OrderValidator::validateSugars($sugars)) {
            $output->writeln('The number of sugars should be between 0 and 2.');
            return Command::FAILURE;
        }

        //place a new order 

        $order = new Order($drinkType, $sugars, $extraHot);

        //make the drink 

        $drinkMaker = new DrinkMaker();
        $drinkMaker->makeDrink($order, $output);

        //save the order to DB 

        $pdo = MysqlPdoClient::getPdo();
        $orderRepository = new OrderSave($pdo);
        $orderRepository->save($order);

        return Command::SUCCESS;
        /*
         $drinkType = strtolower($input->getArgument('drink-type'));
        if (!in_array($drinkType, ['tea', 'coffee', 'chocolate'])) {
            $output->writeln('The drink type should be tea, coffee or chocolate.');
        } else {
        
            
            $money = $input->getArgument('money');
            switch ($drinkType) {
                case 'tea':
                    if ($money < 0.4) {
                        $output->writeln('The tea costs 0.4.');
                        return;
                    }
                    break;
                case 'coffee':
                    if ($money < 0.5) {
                        $output->writeln('The coffee costs 0.5.');
                        return;
                    }
                    break;
                case 'chocolate':
                    if ($money < 0.6) {
                        $output->writeln('The chocolate costs 0.6.');
                        return;
                         
                    }
                    break;
            }

            $sugars = $input->getArgument('sugars');
            $stick = false;
            $extraHot = $input->getOption('extra-hot');
            if ($sugars >= 0 && $sugars <= 2) {
                $output->write('You have ordered a ' . $drinkType);
                if ($extraHot) {
                    $output->write(' extra hot');
                }

                if ($sugars > 0) {
                    $stick = true;
                    $output->write(' with ' . $sugars . ' sugars (stick included)');
                }
                $output->writeln('');
            } else {
                $output->writeln('The number of sugars should be between 0 and 2.');
            }

            $pdo = MysqlPdoClient::getPdo();

            $stmt= $pdo->prepare( 'INSERT INTO orders (drink_type, sugars, stick, extra_hot) VALUES (:drink_type, :sugars, :stick, :extra_hot)');
            $stmt->execute([
                'drink_type' => $drinkType,
                'sugars' => $sugars,
                'stick' => $stick ?: 0,
                'extra_hot' => $extraHot ?: 0,
            ]);
        } */
    }
}
