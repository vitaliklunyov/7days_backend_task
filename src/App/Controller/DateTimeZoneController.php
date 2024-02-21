<?php

namespace App\Controller;

use App\Form\DateTimezoneFormType;
use Domain\DateTimeZone\DateTimeZoneCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DateTimeZoneController extends AbstractController
{
    /**
     * @Route("/date_time_zone", name="app_date_time_zone_index")
     */
    public function index(Request $request, DateTimeZoneCalculator $calculator): Response
    {
        $form = $this->createForm(DateTimezoneFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $result = $calculator->calculate($data);

            return $this->render('date_time_zone/show.html.twig', [
                'result' => $result,
            ]);
        }

        return $this->render('date_time_zone/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
