<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use App\Repository\YoutubeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
   #[Route('/videos', name: 'app_videos')]
   public function index(VideoRepository $repository, Request $request): Response
   {
      $offset = max(0, $request->query->getInt('offset', 0));
      $videos = $repository->findPaginated($offset);

      return $this->render('videos/index.html.twig', [
         'videos' => $videos,
         'previous' => $offset - VideoRepository::PAGINATOR_PER_PAGE,
         'next' => min(count($videos), $offset + VideoRepository::PAGINATOR_PER_PAGE)
      ]);
   }

   #[Route('/video/{id}', name: 'app_video_show')]
   public function show (Video $video): Response
   {
      $this->addFlash('category', 'yes');
      return $this->render('videos/show.html.twig', [
         'video' => $video
      ]);
   }

//   #[Route('/videos/{category}', name: 'youtube.category')]
//   public function category (string $category, YoutubeRepository $repository, Request $request): Response
//   {
//      $offset = max(0, $request->query->getInt('offset', 0));
//      $youtubes = $repository->findByCategory($category, $offset);
//
//      $this->addFlash('category', 'yes');
//      return $this->render('youtube/category.html.twig', [
//         'title' => 'Catégorie ' . $category,
//         'h1' => 'Catégorie ' . $category,
//         'videos' => $youtubes,
//         'previous' => $offset - YoutubeRepository::PAGINATOR_PER_PAGE,
//         'next' => min(count($youtubes), $offset + YoutubeRepository::PAGINATOR_PER_PAGE)
//      ]);
//   }
}
