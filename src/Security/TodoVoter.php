<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class TodoVoter implements VoterInterface {

   const TODO_VOTER = 'TODO_VOTER';

   public function vote (TokenInterface $token, mixed $subject, array $attributes) : bool {

      return true;
   }
}