<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Event\LogoutEvent;


class MyCustomLogoutListener
{

   public function __construct(private readonly RequestStack $requestStack)
   {
   }

   public function __invoke(LogoutEvent $event) : void
   {
      $this->requestStack->getSession()->getFlashBag()->add('success', 'Déconnexion réussie!');
   }
}