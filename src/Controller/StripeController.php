<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Stripe\StripeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{

   #[Route('/stripe-payment', name: 'stripe.payment')]
   public function checkout(#[Autowire(env: "STRIPE_SECRET")] $stripeSecret): Response
   {
      $stripe = new StripeClient($stripeSecret);

      $checkout_session = $stripe->checkout->sessions->create([
         'customer_email' => $this->getUser()->getEmail(),
         'line_items' => [[
            'price_data' => [
               'currency' => 'EUR',
               'product_data' => [
                  'name' => 'PremiumMember'
               ],
               'unit_amount' => 200
            ],
            'quantity' => 1
         ]],
         'mode' => 'payment',
         'success_url' => "https://informhacktion.com/stripe-success",
         'cancel_url' => "https://informhacktion.com/stripe-cancel",
      ]);


      return $this->redirect($checkout_session->url);
   }

   #[Route('/stripe-success', name: 'stripe.success')]
   public function success(EntityManagerInterface $entityManager): Response
   {
      $user = $this->getUser();
      if ($user) {
         $user->addRole('ROLE_PREMIUM');
         $this->addFlash('success', "Le paiement Stripe a bien été effectué");
         $entityManager->persist($user);
         $entityManager->flush();
      } else {
         $this->addFlash('error', "Veuillez vous connecter");
      }

      return $this->redirectToRoute('app_home');
   }

   #[Route('/stripe-cancel', name: 'stripe.cancel')]
   public function cancel(): Response
   {
      $this->addFlash('error', "Il y a eu une erreur avec le paiement Stripe");
      return $this->redirectToRoute('app_home');
   }

}