<?php

namespace App\Controller;

use App\Entity\React;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReactController extends AbstractController {

   public function __invoke (React $data) : React  {
      return $data;
   }
}