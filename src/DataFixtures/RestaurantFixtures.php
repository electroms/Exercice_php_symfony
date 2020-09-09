<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use App\Repository\CityRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RestaurantFixtures extends Fixture implements DependentFixtureInterface
{
    private $cityRepository;

    public function __construct(CityRepository $cityRepository) {
        $this->cityRepository = $cityRepository;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $restaurant = new Restaurant();
            $restaurant->setName( $faker->company );
            $restaurant->setDescription( $faker->realText( random_int(100, 300) ) );
            $restaurant->setCreatedAt( $faker->dateTimeBetween('-2 years', 'now') );

            $restaurant->setCity( $this->cityRepository->find( random_int(1, 1000) ) );

            $manager->persist($restaurant);
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        return [
          CityFixtures::class
        ];
    }
}
