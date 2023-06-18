<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;

class MailerService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param MailerInterface $mailer
     * @return boolean
     */
    public function sendEmail(MailerInterface $mailer)
    {
        $users = $this->userRepository->findUsersByRole();
        foreach ($users as $user) {
            $email = (new Email())
                ->from('no-reply@example.com')
                ->to($user)
                ->subject('Project Status Update!')
                ->html('<p>Status updated successfully!</p>');

            $mailer->send($email);
        }

        return true;
    }
}
