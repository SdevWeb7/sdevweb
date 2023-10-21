<?php

namespace App\Twig\Runtime;

use RicardoFiorani\OEmbed\OEmbed;
use Twig\Extension\RuntimeExtensionInterface;
use GuzzleHttp\Psr7\Uri;

class YoutubeExtensionRuntime implements RuntimeExtensionInterface {

   private OEmbed $service;

   public function __construct()
   {
      $this->service = new OEmbed();
   }

   public function youtubeThumbnail($value) : string
   {
      return $this->service->get(
         new Uri($value),
         null,
         null,
         ['omitscript' => true]
      )->getThumbnailUrl();

   }

   public function youtubePlayer($value) : string
   {
      return $this->service->get(
         new Uri($value),
         null,
         null,
         ['omitscript' => true]
      );
   }
}