<?php

namespace App\Twig\Runtime;

use RicardoFiorani\Matcher\VideoServiceMatcher;
use Twig\Extension\RuntimeExtensionInterface;

class YoutubeExtensionRuntime implements RuntimeExtensionInterface
{
   private VideoServiceMatcher $youtubeParser;
   public function __construct()
   {
      $this->youtubeParser = new VideoServiceMatcher();
   }

   public function youtubeThumbnail($value) : string
   {
      $video = $this->youtubeParser->parse($value);
      return $video->getLargestThumbnail();
   }

   public function youtubePlayer($value) : string
   {
      $video = $this->youtubeParser->parse($value);
      return $video->getEmbedCode('100%', 500, true, true);
   }
}