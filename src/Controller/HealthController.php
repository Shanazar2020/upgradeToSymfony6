<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthController extends AbstractController
{
    /**
     * @Route("/health")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        print_r($_ENV['DATABASE_URL']);
        dd('hea');
    }
}
