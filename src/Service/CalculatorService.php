<?php

namespace App\Service;

use App\Entity\Operation;
use App\Utils\CalculatorUtils;

/**
 * Calculator service.
 */
class CalculatorService 
{
    /**
     * Method that parses the input for the calculator and returns the calculated result
     * @param Operation $operation class that contains the input from the calculator form
     * @return float or null if division by zero
     */
    public function doCalculation(Operation $operation) : ?float
    {
        // Constant with allowed operators used by the calculator
        define('SYMBOLS', ['+','-','*','/']);

        $operands = [];
        $operators = [];
        $input = $operation->getInput();
        // Parse the input from the calculator until it is empty
        while (strlen($input) > 0) {
            // Calculate the position for the first operator in input
            $pos = CalculatorUtils::getFirstPositionFromElements($input, SYMBOLS);
            // If there are no operators return the input
            if (!$pos) {
                $operands[] = $input;
                break;
            }
            // Gets the operand before the operator found and save it in operands array
            $operands[] = substr($input, 0, $pos);
            // Saves the operator found in operators array 
            $operators[] = substr($input, $pos, 1);
            // Removes from the input the already parsed entry
            $input = substr($input, $pos+1, strlen($input));
        }

        $result = 0;
        // Do the calculations using both operands and operators array
        foreach ($operands as $ope) {
            // First insert the first operand
            if (empty($result)) {
                $result = $ope;
            } else {
                // Then for each operand do the calculations and accumulate
                $result = CalculatorUtils::doOperation($result, $operators[0], $ope);
                if (!$result) {
                    return $result;
                }
                // Remove the first used operator from the array
                array_shift($operators);
            }
        }
        return $result;
    }
}
