<?php

namespace App\Controller;

use ApiPlatform\Api\UrlGeneratorInterface;
use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
   #[Route('/videos', name: 'app_videos')]
   public function index(VideoRepository $repository, Request $request, UrlGeneratorInterface $urlGenerator): Response
   {
      $offset = max(0, $request->query->getInt('offset', 0));

      if ($request->get('category')) {
         $category = $request->get('category');
         $videos = $repository->findByCategory($category, $offset);
         $next = min(count($videos), $offset + VideoRepository::PAGINATOR_PER_PAGE);
         $previous = $offset - VideoRepository::PAGINATOR_PER_PAGE;
         $hrefNext = $urlGenerator->generate('app_videos', ['offset' => $next, 'category' => $category]);
         $hrefPrevious = $urlGenerator->generate('app_videos', ['offset' => $previous, 'category' => $category]);
         $h1 = 'Categorie ' . $category;
         $title = 'Categorie ' . $category;
      } else {
         $videos = $repository->findPaginated($offset);
         $next = min(count($videos), $offset + VideoRepository::PAGINATOR_PER_PAGE);
         $previous = $offset - VideoRepository::PAGINATOR_PER_PAGE;
         $hrefNext = $urlGenerator->generate('app_videos', ['offset' => min(count($videos), $offset + VideoRepository::PAGINATOR_PER_PAGE)]);
         $hrefPrevious = $urlGenerator->generate('app_videos', ['offset' => $offset - VideoRepository::PAGINATOR_PER_PAGE]);
         $h1 = 'Toutes les vidéos';
         $title = 'Toutes les vidéos';
      }


      return $this->render('videos/index.html.twig', [
         'videos' => $videos,
         'previous' => $previous,
         'next' => $next,
         'hrefPrevious' => $hrefPrevious,
         'hrefNext' => $hrefNext,
         'h1' => $h1,
         'title' => $title

      ]);
   }


   #[Route('/video/{id}', name: 'app_video_show')]
   public function show (Video $video): Response
   {
      return $this->render('videos/show.html.twig', [
         'video' => $video
      ]);
   }

}
