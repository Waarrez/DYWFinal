<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Commentary;
use App\Entity\Profile;
use App\Entity\Subject;
use App\Entity\Tutorial;
use App\Entity\User;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();

        for ($u = 0; $u < 10; $u++) {
            $user = new User();
            $profile = new Profile();

            $profile->setFirstName($faker->firstName)
                    ->setLastName($faker->lastName)
                    ->setAge($faker->randomNumber(2))
                    ->setProfilePicture($faker->imageUrl());

            $hashPass = $this->hasher->hashPassword($user, "password");

            $user->setEmail($faker->email)
                 ->setUsername($faker->userName)
                 ->setPassword($hashPass)
                 ->setProfile($profile);

            $manager->persist($user);
            $manager->persist($profile);

            $tutorial = new Tutorial();
            $commentary = new Commentary();
            $category = new Category();
            $subject = new Subject();

            $category->setName("Catégorie n°$u")
                ->setContent("Contenu n° $u")
                ->setImage($faker->imageUrl());


            $tutorial->setTitle("Titre n°$u")
                     ->setContent("Contenu n°$u")
                     ->setUrl("www.youtube.com")
                     ->addCommentary($commentary)
                     ->setSlug($slugify->slugify($tutorial->getTitle()))
                     ->addCategory($category);

            $commentary->addTutorial($tutorial)
                       ->setContent("Commentaire n°$u")
                       ->setUsers($user);

            $subject->setTitle("Titre n°$u")
                    ->setContent("Contenu n° $u")
                    ->addCommentary($commentary)
                    ->addCategory($category)
                    ->setUsers($user);

            $manager->persist($tutorial);
            $manager->persist($commentary);
            $manager->persist($subject);
            $manager->persist($category);
        }


        $manager->flush();
    }
}
