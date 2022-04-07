<?php

namespace App\Controller;

use App\Domain\Booking\Form\BookTicketCommandType;
use App\Domain\Booking\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    /** @Route("/", name="home", methods={"GET", "POST"}) */
    public function home(Request $request, SessionRepository $sessionRepository, MessageBusInterface $bus): Response
    {
        $sessions = $sessionRepository->findAll();
        $form = $this->createForm(BookTicketCommandType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command = $form->getData();
            $session = $sessionRepository->findById($command->sessionId);

            if (!$session->hasFreeTickets()) {
                $this->addFlash('error', 'Билеты кончились');

                return $this->redirectToRoute('home');
            }

            $bus->dispatch($command);

            return $this->redirectToRoute('home');
        }

        return $this->render('main.html.twig', ['sessions' => $sessions, 'form' => $form]);
    }
}
