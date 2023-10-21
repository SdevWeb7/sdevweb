<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

class ThemeListener
{

   public function __construct(private readonly Environment $twig)
   {
   }

   public function __invoke(RequestEvent $event) : void
   {

      $theme = $event->getRequest()->cookies->get('modeSombre') === 'active';
      $this->twig->addGlobal('themeSombre', $theme);

   }
}