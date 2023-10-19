<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\YoutubeExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class YoutubeExtension extends AbstractExtension
{
   public function getFilters(): array
   {
      return [
         new TwigFilter('youtube_thumbnail', [YoutubeExtensionRuntime::class, 'youtubeThumbnail']),
         new TwigFilter('youtube_player', [YoutubeExtensionRuntime::class, 'youtubePlayer']),
      ];
   }

   public function getFunctions(): array
   {
      return [
         new TwigFunction('youtube_thumbnail', [YoutubeExtensionRuntime::class, 'youtubeThumbnail']),
         new TwigFunction('youtube_player', [YoutubeExtensionRuntime::class, 'youtubePlayer']),
      ];
   }
}
