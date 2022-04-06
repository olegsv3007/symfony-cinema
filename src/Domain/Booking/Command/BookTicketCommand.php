<?php

namespace App\Domain\Booking\Command;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

final class BookTicketCommand
{
    /** @Assert\NotBlank(message="Поле 'Имя' не можеть быть пустым") */
    public string $clientName;

    /**
     * @Assert\NotBlank(message="Поле 'Номер телефона' не может быть пустым")
     * @Assert\Length(
     *     min=9,
     *     max=14,
     *     minMessage="Номер телефона должен состоять минимум из 9 символов",
     *     max="Номер телефона должен состоять минимум из 14 символов",
     * )
     * @Assert\Regex(
     *     pattern="/^[0-9]{9,14}\z/",
     *     message="Указан неверный формат номера телефона",
     * )
     */
    public string $phoneNumber;

    public function __construct(public Uuid $sessionId, string $clientName, string $phoneNumber)
    {
        $this->clientName = $clientName;
        $this->phoneNumber = $phoneNumber;
    }
}
