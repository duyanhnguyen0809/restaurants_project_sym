<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Restaurant;
use App\Entity\Menu;
use App\Entity\Table;
use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {   

        // Create an Admin user
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        // Create a regular User
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'user123'));
        $manager->persist($user);

        // Create a Banned user
        $banned = new User();
        $banned->setEmail('banned@example.com');
        $banned->setRoles(['ROLE_BANNED']);
        $banned->setPassword($this->passwordHasher->hashPassword($banned, 'banned123'));
        $manager->persist($banned);


        // Create Restaurants
        $restaurant1 = new Restaurant();
        $restaurant1->setName('Gourmet Paradise');
        $restaurant1->setLocation('Downtown');
        $manager->persist($restaurant1);

        $restaurant2 = new Restaurant();
        $restaurant2->setName('Cozy Diner');
        $restaurant2->setLocation('Suburb');
        $manager->persist($restaurant2);

        // Create Menus for Restaurants
        $menu1 = new Menu();
        $menu1->setName('Breakfast Special');
        $menu1->setPrice(9.99);
        $menu1->setRestaurant($restaurant1);
        $manager->persist($menu1);

        $menu2 = new Menu();
        $menu2->setName('Steak Dinner');
        $menu2->setPrice(19.99);
        $menu2->setRestaurant($restaurant1);
        $manager->persist($menu2);

        $menu3 = new Menu();
        $menu3->setName('Veggie Delight');
        $menu3->setPrice(12.99);
        $menu3->setRestaurant($restaurant2);
        $manager->persist($menu3);

        // Create Tables for Restaurants
        $table1 = new Table();
        $table1->setNumber(1);
        $table1->setCapacity(4);
        $table1->setRestaurant($restaurant1);
        $manager->persist($table1);

        $table2 = new Table();
        $table2->setNumber(2);
        $table2->setCapacity(2);
        $table2->setRestaurant($restaurant1);
        $manager->persist($table2);

        $table3 = new Table();
        $table3->setNumber(1);
        $table3->setCapacity(6);
        $table3->setRestaurant($restaurant2);
        $manager->persist($table3);

        // Create Reservations
        $reservation1 = new Reservation();
        $reservation1->setDate(new \DateTime('2024-12-20 08:00:00'));
        $reservation1->setCustomerName('John Doe');
        $reservation1->setRestaurantTable($table1);
        $manager->persist($reservation1);

        $reservation2 = new Reservation();
        $reservation2->setDate(new \DateTime('2024-12-20 18:00:00'));
        $reservation2->setCustomerName('Jane Smith');
        $reservation2->setRestaurantTable($table2);
        $manager->persist($reservation2);

        // Flush data to the database
        $manager->flush();
    }
}
