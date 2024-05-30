<?php

namespace App\Controller;

use App\Form\DateType;
use App\Service\DateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DateController extends AbstractController
{
    /**
     * @Route("/date", name="app_date_index")
     */
    public function index(Request $request, DateService $dateService): Response
    {
        $form = $this->createForm(DateType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $input = $form->getData();
            $output = $dateService->getOutput($input);

            return $this->render('date/show.html.twig', [
                'input' => $input,
                'output' => $output,
            ]);
        }

        return $this->render('date/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
