<?php

namespace App\Controller;

use App\Entity\Like;
use App\Repository\LikeRepository;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
   #[Route('/like/{id}/{username}', name: 'app_like', methods: ['POST'])]
   public function index(int $id, string $username, LikeRepository $likeRepository, EntityManagerInterface $manager, UserRepository $userRepository, VideoRepository $videoRepository): JsonResponse
   {
      $user = $userRepository->findOneBy(['username' => $username]);
      $video = $videoRepository->findOneBy(['id' => $id]);

      if ($user->getUsername() === 'anonymous') {
         return new JsonResponse([]);
      }

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
