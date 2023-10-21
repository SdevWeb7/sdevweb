<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil', methods: ['GET', 'POST'])]
    public function index(Request $request, CsrfTokenManagerInterface $csrfTokenManager, EntityManagerInterface $manager): Response
    {
       if (!$this->getUser()) {
          return $this->redirectToRoute('app_login');
       }

        if ($request->isMethod('POST')) {
           $token = $request->request->get('_token');
           if (!$csrfTokenManager->isTokenValid(new CsrfToken('modify_profil', $token))) {
              $this->addFlash('error', 'Jeton Csrf Invalide.');
              $this->redirectToRoute('app_home');
           }
           $user = $this->getUser();
           $user->setUsername($request->get('username'));
           $user->setEmail($request->get('email'));
           $manager->persist($user);
           $manager->flush();

           $this->addFlash('success', 'Profil Modifié');
           return $this->redirectToRoute("app_home");
        }

        return $this->render('profil/index.html.twig');
    }

   #[Route('/profil/delete', name: 'app_profil_delete')]
   public function delete (Request $request, EntityManagerInterface $manager, CsrfTokenManagerInterface $csrfTokenManager): Response
   {
      if (!$this->getUser()) {
         return $this->redirectToRoute('app_login');
      }
      if ($request->isMethod('POST')) {

         $token = $request -> request -> get('_token2');
         if (! $csrfTokenManager -> isTokenValid(new CsrfToken('delete_profil', $token))) {
            $this -> addFlash('error', 'Jeton Csrf Invalide.');
            $this -> redirectToRoute('app_home');
         }

         $user = $this->getUser();
         $manager->remove($user);
         $manager->flush();

         $this->addFlash('success', 'Votre profil a été supprimé');
      }
         return $this->redirectToRoute('app_home');
   }
}
