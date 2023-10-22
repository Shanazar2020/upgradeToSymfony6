<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends BaseController
{
    /**
     * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
     */
    #[Route(path: '/api/me', name: 'app_user_api_me_index', methods: ['GET'])]
    public function apiMe(): Response
    {
        return $this->json($this->getUser(), 200, [], [
            'groups' => ['user:read'],
        ]);
    }
}
