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

        for ($u = 0; $u < 20; $u++) {
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

            for ($c = 0; $c < 20; $c++) {
                $tutorial = new Tutorial();
                $commentary = new Commentary();
                $category = new Category();
                $subject = new Subject();

                $category->setName("Catégorie n°$c")
                    ->setContent("Contenu n° $c")
                    ->setImage($faker->imageUrl());


                $tutorial->setTitle("Titre n°$c")
                         ->setContent("Contenu n°$c")
                         ->setUrl("www.youtube.com")
                         ->addCommentary($commentary)
                         ->addCategory($category);

                $tutorial->setSlug($slugify->slugify($tutorial->getTitle()));

                $commentary->addTutorial($tutorial)
                           ->setContent("Commentaire n°$c")
                           ->setUsers($user);

                $subject->setTitle("Titre n°$c")
                        ->setContent("Contenu n° $c")
                        ->addCommentary($commentary)
                        ->addCategory($category)
                        ->setUsers($user);

                $manager->persist($tutorial);
                $manager->persist($commentary);
                $manager->persist($subject);
                $manager->persist($category);
            }
        }


        $manager->flush();
    }
}
