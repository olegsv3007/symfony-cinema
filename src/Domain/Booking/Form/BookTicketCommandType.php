<?php

namespace App\Domain\Booking\Form;

use App\Domain\Booking\Command\BookTicketCommand;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UuidType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class BookTicketCommandType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sessionId', UuidType::class)
            ->add('clientName', TextType::class)
            ->add('phoneNumber', TextType::class)
            ->add('Book', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookTicketCommand::class,
        ]);
    }
}
