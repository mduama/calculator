<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsNumberOrOperator extends Constraint
{
    public $message = 'The string "{{ string }}" contains illegal characters';
}
