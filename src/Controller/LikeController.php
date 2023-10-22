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
   #[Route('/like/{id}', name: 'app_like')]
   public function index(Video $video, LikeRepository $likeRepository, EntityManagerInterface $manager): JsonResponse
   {
      if (!$this->getUser()) {
         return new JsonResponse([]);
      }
      $user = $this->getUser();
      $like = $likeRepository->findOneBy(['fromUser' => $user, 'toVideo' => $video]);

      if (!$like) {
         $like = new Like();
         $user->addLike($like);
         $video->addLike($like);
         $manager->persist($like);
         $manager->flush();

         return new JsonResponse(['nbLikes' => count($video->getLikes()), 'likeState' => 'Liké']);
      }

      $video->removeLike($like);
      $user->removeLike($like);
      $manager->remove($like);
      $manager->flush();

      return new JsonResponse(['nbLikes' => count($video->getLikes()), 'likeState' => 'Unliké']);

   }
}
