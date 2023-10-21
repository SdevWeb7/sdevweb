<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class ReactVoter implements VoterInterface {

   const REACT_VOTER = 'REACT_VOTER';

   public function vote (TokenInterface $token, mixed $subject, array $attributes) : bool {

      return true;
   }
}