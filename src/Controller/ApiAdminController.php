<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\SerializerBuilder;


/**
 * @Route("/api/admin")
 */
class ApiAdminController extends AbstractController {
    /**
     * @Route("/{id}", name="api_admin_index")
     * @param User $user
     */
    public function index(User $user) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

		$serializer = SerializerBuilder::create()->build();

        return new JsonResponse($serializer->serialize($user, 'json'), 200);
    }
}
