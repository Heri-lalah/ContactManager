<?php

namespace App\DataFixtures;


use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $genderList = ["M", "F"];

        for($i=1; $i<50; $i++){

            $gender = $genderList[rand(0,1)];
            $genderForFakeImage = "";

            if($gender=="M")
            {
                $genderForFakeImage = "men";
            }else{
                $genderForFakeImage = "women";
            }

            $fakeData = \Faker\Factory::create();
            $contact = new Contact();
            $contact->setName($fakeData->name);
            $contact->setGender($gender);
            $contact->setImage("https://randomuser.me/api/portraits/" . $genderForFakeImage . "/" . $i .".jpg");
            $contact->setAdress($fakeData->address);
            $contact->setCp($fakeData->postcode);
            $contact->setPhoneNumber($fakeData->phoneNumber);

            $manager->persist($contact);
        }

        $manager->flush();
    }
}
