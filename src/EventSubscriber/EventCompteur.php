<?php

namespace App\EventSubscriber;

use App\Service\Compteur;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class EventCompteur implements EventSubscriberInterface
{
   public function __construct (private readonly Compteur $compteur, private readonly Environment $twig)
   {}

   public function compteur(): void
   {
      $this->compteur->incrementer();
      $this->twig->addGlobal('compteur', $this->compteur->recuperer());
   }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['compteur'],
        ];
    }
}
