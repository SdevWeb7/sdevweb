<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\Video;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
   #[Route('/like/{id}', name: 'app_like', methods: ['POST'])]
   public function index(Video $video, LikeRepository $likeRepository, EntityManagerInterface $manager): JsonResponse
   {
      if (!$this->getUser()) {
         return $this->json([]);
      }

      $like = $likeRepository->findOneBy(['fromUser' => $this->getUser(), 'toVideo' => $video]);

      if (!$like) {
         $like = new Like();
         $this->getUser()->addLike($like);
         $video->addLike($like);
         $manager->persist($like);
         $manager->flush();

         return new JsonResponse(['nbLikes' => count($video->getLikes()), 'likeState' => 'Liké']);
      }

      $video->removeLike($like);
      $this->getUser()->removeLike($like);
      $manager->remove($like);
      $manager->flush();

      return new JsonResponse(['nbLikes' => count($video->getLikes()), 'likeState' => 'Unliké']);

   }
}
