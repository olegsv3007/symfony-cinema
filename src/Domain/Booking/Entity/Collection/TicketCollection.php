<?php

namespace App\Domain\Booking\Entity\Collection;

use App\Domain\Booking\Entity\Ticket;
use InvalidArgumentException;
use Iterator;

class TicketCollection implements Iterator
{
    private int $pointer = 0;

    /**
     * @param array<Ticket> $tickets
     */
    public function __construct(private array $tickets = [])
    {
        $this->validateItems($tickets);
    }

    public function add(Ticket $ticket): void
    {
        $this->tickets[] = $ticket;
    }

    public function remove(Ticket $ticket): void
    {
        $key = array_search($ticket, $this->tickets, true);

        if ($key === false) {
            return;
        }

        unset($this->tickets[$key]);
    }

    public function contains(Ticket $ticket): bool
    {
        return in_array($ticket, $this->tickets, true);
    }

    public function count(): int
    {
        return count($this->tickets);
    }

    public function current(): Ticket
    {
        return $this->tickets[$this->pointer];
    }

    public function next(): void
    {
        $this->pointer++;
    }

    public function key(): int
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return isset($this->tickets[$this->pointer]);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }

    /**
     * @param array<Ticket> $tickets
     */
    private function validateItems(array $tickets): void
    {
        array_walk($tickets, static function ($ticket): void {
            if (!($ticket instanceof Ticket)) {
                throw new InvalidArgumentException();
            }
        });
    }
}
