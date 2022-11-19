<?php

namespace App\MessageHandler;


use App\Entity\Donor;
use App\Message\SendWelcomeEmailMessage;
use App\Repository\DonorRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;

class SendWelcomeEmailMessageHandler implements MessageHandlerInterface
{
    private MailerInterface $mailer;
    private DonorRepository $donorRepository;

    public function __construct(MailerInterface $mailer, DonorRepository $donorRepository)
    {
        $this->mailer = $mailer;
        $this->donorRepository = $donorRepository;
    }


    public function __invoke(SendWelcomeEmailMessage $message)
    {
        // TODO: Implement __invoke() method.

        $donor = $this->donorRepository->find($message->getDonorId());

        $name = $donor->getName();
        $email = $donor->getMail();

        $text = <<<Body
Hello $name;

Thank you for singing up to bloodBank!
Body;
        $email = (new Email())
            ->from('support@bloodbank.com')
            ->to($email)
            ->subject('Welcome to BloodBank!')
            ->text($text);


        $this->mailer->send($email);


    }

}