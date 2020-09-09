<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(RestaurantRepository $restaurantRepository)
    {
        return $this->render('app/index.html.twig', [
            'restaurants' => $restaurantRepository->findLastTen()
        ]);
    }
}
