<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;


class MyCustomLoginListener
{

   public function __construct(private readonly RequestStack $requestStack)
   {
   }

   public function __invoke(LoginSuccessEvent $event) : void
   {
      $this->requestStack->getSession()->getFlashBag()->add('success', 'Connexion réussie!');
   }
}