<?php

namespace App\Events;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use ApiPlatform\Symfony\Validator\Exception\ValidationException;
use App\Classes\Mail;
use App\Entity\Profile;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PasswordEncoderSubscriber implements EventSubscriberInterface


{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
        private readonly EntityManagerInterface $entityManager,
        private readonly ValidatorInterface $validator
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE]
        ];
    }

    public function encodePassword(ViewEvent $event): void
    {
        $result = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($result instanceof User && $method === "POST") {
            $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $result->getEmail()]);

            if ($existingUser === null) {
                try {
                    $hash = $this->hasher->hashPassword($result, $result->getPassword());
                    $result->setPassword($hash);
                    $profile = new Profile();
                    $result->setProfile($profile);
                    $mail = new Mail();
                    $mail->send($result->getEmail(),$result->getUsername(), $result->getIsVerify());
                } catch (ValidationException $exception) {
                    // Une exception ValidationException est levée lorsqu'il y a une erreur de validation
                    // Vous pouvez ajouter ici la logique pour gérer l'erreur de validation
                    // Par exemple, récupérer les erreurs de validation et les traiter
                    $errors = $this->validator->validate($result);
                    // Gérer les erreurs de validation selon vos besoins
                } catch (\Exception $exception) {
                    // Une exception générale est levée pour toutes les autres erreurs
                    // Vous pouvez ajouter ici la logique pour gérer l'erreur
                    // par exemple, enregistrer l'erreur dans les journaux et notifier l'administrateur
                }
            }
        }
    }
}
