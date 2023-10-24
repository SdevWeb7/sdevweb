<?php

namespace App\Security;

use App\Entity\Todo;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class TodoVoter implements VoterInterface {

   const NOT_ANONYME = 'NOT_ANONYME';

   public function vote (TokenInterface $token, mixed $subject, array $attributes) : bool {

      if (in_array(self::NOT_ANONYME, $attributes) && $subject instanceof Todo) {
         return true;
      }

      return false;
   }
}