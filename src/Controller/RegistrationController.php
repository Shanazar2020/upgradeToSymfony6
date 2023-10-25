<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, VerifyEmailHelperInterface $verifyEmailHelper, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $signatureComponents = $verifyEmailHelper->generateSignature(
                'app_verify_email',
                $user->getId(),
                $user->getEmail(),
                ['id' => $user->getId()]
            );

            $signedUrl = $signatureComponents->getSignedUrl();
            $this->sendVerificationEmail($mailer, $user, $signedUrl);
            $this->addFlash('success', sprintf(
                'Confirm your email - the verify link as sent to %s',
                $user->getEmail()
            ));

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route(path: '/verify', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, VerifyEmailHelperInterface $verifyEmailHelper, UserRepository $userRepository, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $user = $userRepository->find($request->query->get('id'));
        if (!$user) {
            throw $this->createNotFoundException();
        }

        try {
            $verifyEmailHelper->validateEmailConfirmation(
                $request->getUri(),
                $user->getId(),
                $user->getEmail()
            );
        } catch (VerifyEmailExceptionInterface $e) {
            $this->addFlash('error', $e->getReason());

            return $this->redirectToRoute('app_register');
        }

        $user->setIsVerified(true);
        $entityManager->flush();

        $this->addFlash('success', 'Account Verified! You can now log in');

        return $this->redirectToRoute('app_login');
    }

    #[Route(path: '/verify/resend', name: 'app_verify_resend_email')]
    public function resendVerifyEmail(): Response
    {
        return $this->render('registration/resend_verify_email.html.twig');
    }

    private function sendVerificationEmail(MailerInterface $mailer, User $user, string $signedUrl): void
    {
        $emailTemplate = <<<EOT
            <!DOCTYPE html>
            <html>
            <head>
                <title>Email Verification</title>
            </head>
            <body>
                <p>Dear {$user->getFirstName()},</p>
                
                <p>Thank you for signing up! To complete your registration, please click the following link to verify your email address:</p>
                
                <p><a href="{$signedUrl}">Verify Email</a></p>
                
                <p>If you did not sign up for this service, you can safely ignore this email.</p>
                
                <p>Best regards,</p>
                <p>Cauldron Overflow</p>
            </body>
            </html>
        EOT;
        $email = (new Email())
            ->from('hello@example.com')
            ->to($user->getEmail())
            ->subject('Verify your email on Cauldron Overflow!')
            ->text('Please, follow the link to verify your email')
            ->html($emailTemplate);

        $mailer->send($email);
    }
}
