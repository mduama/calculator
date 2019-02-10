<?php

namespace App\Entity;

/**
 * Operation class used to manage input from the calculator.
 */
class Operation
{
    /**
     * @App\Validator\ContainsNumberOrOperator
     */
    protected $input;

    public function getInput()
    {
        return $this->input;
    }

    public function setInput($input)
    {
        $this->input = $input;
    }
}
