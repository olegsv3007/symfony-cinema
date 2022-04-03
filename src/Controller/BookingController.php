<?php

namespace App\Controller;

use App\Domain\Booking\Command\BookTicketCommand;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTOFactory;
use App\Domain\Booking\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

final class BookingController extends AbstractController
{
    /** @Route("/", name="app.main", methods={"GET"}) */
    public function sessions(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findAll();

        return $this->render('main.html.twig', ['sessions' => $sessions]);
    }

    /** @Route("/session/{sessionId}/book", name="app.book", methods={"POST"}) */
    public function book(Request $request, int $sessionId, MessageBusInterface $bus): Response
    {
        $clientInfo = BookTicketDTOFactory::createFromRequest($request);

        try {
            $command = new BookTicketCommand($sessionId, $clientInfo);
            $bus->dispatch($command);
        } catch (HandlerFailedException $e) {
            $this->addFlash('notice', $e->getPrevious()->getMessage());
        }

        return $this->redirectToRoute('app.main');
    }
}
