<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\SerializerBuilder;


use App\Service\Admin\ManageGroupsService;


/**
 * @Route("/api/admin")
 */
class ApiAdminController extends AbstractController {
	private $manageGroupsService;

	public function __construct(
		ManageGroupsService $manageGroupsService
	) {
        $this->manageGroupsService = $manageGroupsService;
    }


	/**
     * @Route("/create-group", name="api_admin_create_group")
     */
    public function createGroup() {
    	$userId = $this->getUser()->getId();
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $newGroupMessage = $this->manageGroupsService->createGroup($userId);

        return new JsonResponse('{"message": ' . $newGroupMessage . ' has been created.}', 200);
    }


    /**
     * @Route("/{id}", name="api_admin_index")
     * @param User $user
     */
    public function showUser(User $user) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

		$serializer = SerializerBuilder::create()->build();

        return new JsonResponse($serializer->serialize($user, 'json'), 200);
    }
}
