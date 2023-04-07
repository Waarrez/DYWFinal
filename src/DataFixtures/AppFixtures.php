<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\CommentarySubject;
use App\Entity\CommentaryTutorial;
use App\Entity\Profile;
use App\Entity\Subject;
use App\Entity\Tutorial;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ){}

    public function load(ObjectManager $manager): void
    {
        for($u = 0; $u < 20; $u++) {

            $user = new User();
            $profile = new Profile();
            $profile->setFirstName("Prénom$u")
                    ->setLastName("Nom$u")
                    ->setAge($u);

            $password = "password";
            $newPass = $this->hasher->hashPassword($user, $password);


            $user->setEmail("utilisateur$u@domain.fr")
                 ->setUsername("utilisateur$u")
                 ->setPassword($newPass)
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setProfile($profile);



            $category = new Category();
            $category->setContent("Contenu de la catégorie")
                ->setName("Catégorie$u")
                ->setImage("Url de l'image");

            $tutorial = new Tutorial();
            $commentaryTutorial = new CommentaryTutorial();

            $tutorial->setName("Tutoriel $u")
                     ->setContent("Contenu du tutoriel")
                     ->setPublishedAt(new \DateTimeImmutable())
                     ->setUrl("www.youtube.com")
                     ->addCategory($category);

            $commentaryTutorial->setContent("Voici un commentaire")
                               ->setUsername($user->getUsername())
                               ->setTutorial($tutorial)
                               ->setUsers($user);

            $subject = new Subject();
            $commentarySubject = new CommentarySubject();

            $subject->setTitle("Problème n°$u")
                    ->setContent("Voici mon problème")
                    ->setCreatedAt(new \DateTimeImmutable())
                    ->addCategory($category);

            $commentarySubject->setUsers($user)
                              ->setSubject($subject)
                              ->setContent("Pour régler ton problème il faut");

            $category->addSubject($subject);

            $manager->persist($tutorial);
            $manager->persist($commentaryTutorial);
            $manager->persist($subject);
            $manager->persist($commentarySubject);
            $manager->persist($commentaryTutorial);
            $manager->persist($category);
            $manager->persist($user);
            $manager->persist($profile);

        }

        $manager->flush();
    }
}
