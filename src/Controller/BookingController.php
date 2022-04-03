<?php

namespace App\Controller;

use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTOFactory;
use App\Domain\Booking\Exception\TicketsAreOverException;
use App\Domain\Booking\Repository\SessionRepository;
use App\Domain\Booking\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function book(Request $request, Session $session, TicketRepository $ticketRepository): Response
    {
        $clientInfo = BookTicketDTOFactory::createFromRequest($request);

        try {
            $ticket = $session->bookTicket($clientInfo);
            $ticketRepository->add($ticket);
        } catch (TicketsAreOverException $e) {
            $this->addFlash('notice', $e->getMessage());
        }

        return $this->redirectToRoute('app.main');
    }
}
