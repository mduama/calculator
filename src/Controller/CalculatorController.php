<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\CalculatorForm;
use App\Entity\Operation;
use App\Service\CalculatorService;

/**
 * Main calculator controller
 */
class CalculatorController extends AbstractController
{
    /**
     * @Route("/calculator", name="calculator")
     */
    public function calculator(Request $request, CalculatorService $calculatorService)
    {
        $operation = new Operation();

        $form = $this->createForm(CalculatorForm::class, $operation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($operation->getInput()) {
                $result = $calculatorService->doCalculation($operation);
                if (!$result) {
                    $this->addFlash(
                        'danger',
                        'Invalid operation: ' . $operation->getInput()
                    );
                } else {
                    $this->addFlash(
                        'primary',
                        'Result: ' . $result
                    );
                }
            } else {
                $this->addFlash(
                    'danger',
                    'Please insert something like: [1+2, 5*6-9]'
                );
            }

            unset($operation);
            unset($form);
            $operation = new Operation();
            $form = $this->createForm(CalculatorForm::class, $operation);
        }

        return $this->render(
            'calculator.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
