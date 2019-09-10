<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\SerializerBuilder;


/**
 * @Route("/api/user")
 */
class ApiUserController extends AbstractController {
    /**
     * @Route("/{id}", name="api_user_detail", methods={"GET"})
     * @param User $user
     * @return JsonResponse
     */
    public function detail(User $user) {
        $this->denyAccessUnlessGranted('view', $user);

        $serializer = SerializerBuilder::create()->build();

        return new JsonResponse($serializer->serialize($user, 'json'), 200);
    }
}
