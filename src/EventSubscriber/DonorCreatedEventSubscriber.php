<?php

namespace App\EventSubscriber;

use App\Entity\Donor;
use App\Event\DonorCreatedEvent;
use App\Message\SendWelcomeEmailMessage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;

class DonorCreatedEventSubscriber implements EventSubscriberInterface
{

   private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public static function getSubscribedEvents()
    {
        return [
            DonorCreatedEvent::class => 'sendEmail',
        ];
    }

    public function sendEmail(DonorCreatedEvent $event)
    {
        $donor = $event->getDonor();

        $donorId = $donor->getId();
        //Send Email when user Create
//        $name = $donor->getName();
//        $email = $donor->getMail();
//
//        $text = <<<Body
//Hello $name;
//
//Thank you for singing up to bloodBank!
//Body;
//        $email = (new Email())
//            ->from('support@bloodbank.com')
//            ->to($email)
//            ->subject('Welcome to BloodBank!')
//            ->text($text);
//
//
//        $this->mailer->send($email);

        $this->bus->dispatch(new SendWelcomeEmailMessage($donorId));

    }
}