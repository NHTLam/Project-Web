<?php

namespace App\Controller;

use App\Entity\Courses;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $home = $this -> getDoctrine() -> getRepository(Courses::class) -> findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'homedata' => $home
        ]);
    }
}
