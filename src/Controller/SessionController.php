<?php

namespace App\Controller;

use App\Domain\Booking\Command\BookTicketCommand;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTOFactory;
use App\Domain\Booking\Exception\TicketsAreOverException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class SessionController extends AbstractController
{
    /** @Route("/session/{sessionId}/book", name="session.book", methods={"POST"}) */
    public function book(Request $request, int $sessionId, MessageBusInterface $bus): Response
    {
        $clientInfo = BookTicketDTOFactory::createFromRequest($request);

        try {
            $command = new BookTicketCommand($sessionId, $clientInfo);
            $bus->dispatch($command);
        } catch (ValidationFailedException $e) {
            foreach ($e->getViolations() as $violation) {
                $this->addFlash('error', $violation->getMessage());
            }
        } catch (HandlerFailedException $e) {
            if ($e->getPrevious() instanceof TicketsAreOverException) {
                $this->addFlash('error', $e->getPrevious()->getMessage());
            }
        }

        return $this->redirectToRoute('home');
    }
}
