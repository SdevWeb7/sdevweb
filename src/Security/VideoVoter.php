<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class VideoVoter implements VoterInterface {

   const VIDEO_VOTER = 'VIDEO_VOTER';

   public function vote (TokenInterface $token, mixed $subject, array $attributes) {

      return true;
   }
}