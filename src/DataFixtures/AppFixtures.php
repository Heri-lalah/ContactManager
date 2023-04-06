<?php

namespace App\DataFixtures;


use App\Entity\Category;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $categories = ["Professionnel", "Sport", "Private"];

        $genderList = ["M", "F"];

        foreach($categories as $categoryItem){

            $fakeData = \Faker\Factory::create();

            $category = new Category();
            $category->setName($categoryItem);
            $category->setDescription($fakeData->paragraph);

            switch ($categoryItem) {
                case "Professionnel" :
                    $image = "business.jpg";
                    break;
                case "Private":
                    $image = "private.png";
                    break;
                default :
                    $image = "sport.png";
                    break;
            }

            $category->setImageUrl($image);

            for($j=1; $j<rand(5,25); $j++){

                $gender = $genderList[rand(0,1)];
                $genderForFakeImage = "";

                if($gender=="M")
                {
                    $genderForFakeImage = "men";
                }else{
                    $genderForFakeImage = "women";
                }

                $contact = new Contact();
                $contact->setName($fakeData->name);
                $contact->setGender($gender);
                $contact->setImage("https://randomuser.me/api/portraits/" . $genderForFakeImage . "/" . $j .".jpg");
                $contact->setAdress($fakeData->address);
                $contact->setCp($fakeData->postcode);
                $contact->setPhoneNumber($fakeData->phoneNumber);
                $contact->setCategory($category);
                $manager->persist($contact);
            }
            $manager->persist($category);
        }

        $manager->flush();
    }
}
