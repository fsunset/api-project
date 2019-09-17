<?php

namespace App\Service\Admin;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Groups;
use App\Entity\Member;


/**
 *
 */
class ManageGroupsService {
	private $em;

    public function __construct(
    	EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

	/**
	 * Creates a group & links its creator as first member
	 */
	function createGroup($userId) {
        $newGroup = new Groups();
        $newGroup->setName('My Cool Group');
        $newGroup->setDescription('This is my very first group, come join us!');
        $this->em->persist($newGroup);
        $this->em->flush();


        $groupMember = new Member();
        $groupMember->setUserId($userId);
        $groupMember->setGroupId($newGroup->getId());
        $this->em->persist($groupMember);
        $this->em->flush();

        return $newGroup->getName();
	}
}
