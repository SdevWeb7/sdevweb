<?php

namespace App\Controller;

use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoController extends AbstractController {

   public function __invoke (Video $data) : Video {
      return $data;
   }
}