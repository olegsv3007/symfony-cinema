<?php

namespace App\Controller;

use App\Domain\Booking\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class BookingController extends AbstractController
{
    /** @Route("/", name="app.main", methods={"GET"}) */
    public function sessions(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findAll();

        return $this->render('main.html.twig', ['sessions' => $sessions]);
    }

    /** @Route("/session/{id}/book", name="app.book", methods={"POST"}) */
    public function book(): Response
    {
        return $this->redirectToRoute('app.main');
    }
}
