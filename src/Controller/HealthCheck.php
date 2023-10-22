<?php

namespace App\Controller;

use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheck extends AbstractController
{

    #[Route(path: '/health-check', methods: 'GET', name: 'health_check')]
    public function healthCheck(AnswerRepository $answerRepository): JsonResponse
    {
        $data = $answerRepository->findOneBy([]);
        dump($data);
        return new JsonResponse([
            'status' => 'success',
            'message' => 'welcome to cauldron'
        ], \Symfony\Component\HttpFoundation\Response::HTTP_OK, []);
    }

}