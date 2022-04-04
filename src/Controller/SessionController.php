<?php

namespace App\Controller;

use App\Domain\Booking\Command\BookTicketCommand;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class SessionController extends AbstractController
{
    /** @Route("/session/{session}/book", name="session.book", methods={"POST"}) */
    public function book(Request $request, Session $session, MessageBusInterface $bus): Response
    {
        if (!$session->hasFreeTickets()) {
            $this->addFlash('error', 'Билеты кончились');

            return $this->redirectToRoute('home');
        }

        $clientInfo = BookTicketDTOFactory::createFromRequest($request);

        try {
            $command = new BookTicketCommand($session->getId()->getId(), $clientInfo);
            $bus->dispatch($command);
        } catch (ValidationFailedException $e) {
            foreach ($e->getViolations() as $violation) {
                $this->addFlash('error', $violation->getMessage());
            }
        }

        return $this->redirectToRoute('home');
    }
}
