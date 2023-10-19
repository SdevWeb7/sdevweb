<?php

namespace App\Message;

class ValidEmail
{

   public function __construct (private readonly int $userID)
   {

   }

   public function getUserID () : int
   {
      return $this->userID;
   }

}