<?php

namespace App\Utils;

/**
 * Calculator utils class.
 */
class CalculatorUtils
{
    /**
     * Method that manages operations based on 2 operands and 1 symbol.
     * @param float $oper1
     * @param string $symbol 
     * @param float $oper2
     * @return float or null if division by zero
     */
    public static function doOperation(float $oper1, string $symbol, float $oper2) : ?float
    {
        switch ($symbol) {
            case '+': return $oper1+$oper2;
            case '-': return $oper1-$oper2;
            case '*': return $oper1*$oper2;
            case '/': return ($oper2 != 0 ? $oper1/$oper2 : null);
        }
    }

    /**
     * Method that returns the position of first occurrence of elements from symbols array in text.
     * @param string $text 
     * @param array $symbols
     * @return int or null if no element from symbols is found in the text
     * @throws Exception
     */
    public static function getFirstPositionFromElements(string $text, array $symbols) : ?int
    {
        $firstSymbolFound = PHP_INT_MAX;
        foreach($symbols as $s) {
            $pos = strpos($text, $s);
            if($pos !== false && ($pos <=> $firstSymbolFound) == -1) {
                $firstSymbolFound = $pos;
            }
        }
        return ($firstSymbolFound == PHP_INT_MAX ? null : $firstSymbolFound);
    }
}
