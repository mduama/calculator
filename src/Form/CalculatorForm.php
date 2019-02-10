<?php

namespace App\Form;

use Symfony\Component\Form\{AbstractType,FormBuilderInterface};
use Symfony\Component\Form\Extension\Core\Type\{SubmitType,ResetType};

/**
 * Form that manages the calculator
 */
class CalculatorForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'input',
                null,
                [
                    'label'    => false,
                    'required' => false,
                ]
            )
            ->add(
                'AC',
                ResetType::class, 
                [
                    'label' => 'AC',
                    'attr'  => 
                        [
                            'class' => 'btn btn-warning'
                        ]
                ]
            )
            ->add('Submit',
                SubmitType::class, 
                [
                    'label' => '=',
                    'attr'  => 
                        [
                            'class' => 'btn btn-info'
                        ]
                ]
            );
    }
}
