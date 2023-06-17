<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Commentary;
use App\Entity\Profile;
use App\Entity\Subject;
use App\Entity\Tutorial;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EntitiesFixtures extends Fixture
{

    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {

            $user = new User();
            $profile = new Profile();
            $tutorial = new Tutorial();
            $category = new Category();
            $subject = new Subject();
            $commentary = new Commentary();

            // User
            $password = "warez";
            $user->setUsername("Utilisation n°$i")
                 ->setEmail("utilisateur$i@domain.fr");

            $hashPassword = $this->hasher->hashPassword($user, $password);

            $user->setPassword($hashPassword)
                 ->setRoles(["ROLE_USER"]);

            // Profile

            $profile->setFirstName("Prénom $i")
                    ->setLastName("Nom $i")
                    ->setAge($i)
                    ->setPictureProfile("https://placehold.co/600x400")
                    ->setUsers($user);

            // Tutorial

            $tutorial->setTitle("Titre n°$i")
                     ->setContent("Contenu")
                     ->setPublishedAt(new \DateTimeImmutable())
                     ->setUrl("www.youtube.com")
                     ->setUsers($user);

            // Category

            $category->setName("Catégorie n°$i")
                     ->setContent("Contenu")
                     ->setImage("https://placehold.co/600x400");

            $tutorial->addCategory($category);

            // Subject

            $subject->setTitle("Titre n°$i")
                    ->setContent("Contenu")
                    ->setCreatedAt(new \DateTimeImmutable())
                    ->addCategory($category)
                    ->setUsers($user);

            // Commentary

            $commentary->setContent("Mon commentaire")
                       ->setCreatedAt(new \DateTimeImmutable())
                       ->setUsers($user);

            $subject->addCommentary($commentary);
            $tutorial->addCommentary($commentary);

            $manager->persist($user);
            $manager->persist($profile);
            $manager->persist($tutorial);
            $manager->persist($category);
            $manager->persist($commentary);
            $manager->persist($subject);
        }

        $manager->flush();
    }
}