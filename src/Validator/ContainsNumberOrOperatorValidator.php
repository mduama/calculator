<?php

namespace App\Validator;

use Symfony\Component\Validator\{Constraint,ConstraintValidator};
use Symfony\Component\Validator\Exception\{UnexpectedTypeException,UnexpectedValueException};

/**
 * Custom validator for the calculator input.
 */
class ContainsNumberOrOperatorValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ContainsNumberOrOperator)
        {
            throw new UnexpectedTypeException($constraint, ContainsNumberOrOperator::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value)
        {
            return;
        }

        if (!is_string($value))
        {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'string');
        }

        // Checks the input only contains numbers and allowed operation symbols
        if (!preg_match('/^[0-9,\/,\+,\-,\*]+$/', $value, $matches))
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
