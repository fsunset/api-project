<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;


class UserVoter extends Voter {
    const VIEW = 'view';
    const EDIT = 'edit';

    private $decisionManager;
    public function __construct(AccessDecisionManagerInterface $decisionManager) {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject) {
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // only vote on User objects inside this voter
        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        // you know $subject is a User object, thanks to supports
        /** @var User $userSubject */
        $userSubject = $subject;
        switch ($attribute) {
            case self::VIEW:
                return $this->canView($userSubject, $user);
            case self::EDIT:
                return $this->canEdit($userSubject, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(User $userSubject, User $user) {
        if ($this->canEdit($userSubject, $user)) {
            return true;
        }
    }

    private function canEdit(User $userSubject, User $user) {
        return $user === $userSubject;
    }
}
