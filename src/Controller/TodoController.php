<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Entity\User;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TodoController extends AbstractController {

   #[Route('/todos/{reactRouting}', name: 'app_todos', defaults: ['reactRouting' => null] )]
   public function todo () : Response {
      return $this -> render('todos/todos.html.twig');
   }

   #[Route('/api/all-todos/{username}', name: 'app_all_todos')]
   public function all_todos (User $user , TodoRepository $todoRepository, NormalizerInterface $normalizer) : Response {

      $todos = $todoRepository->findBy(['fromUser' => $user]);
      $todoNormalized = $normalizer->normalize($todos, null, ['groups' => 'api:todos']);

      return $this->json($todoNormalized);
   }


   #[Route('/api/add-todo/{username}', name: 'app_add_todo', methods: ['POST'])]
   public function add_todo (User $user, Request $request, EntityManagerInterface $manager) : JsonResponse {

      if ($user->getUsername() === 'anonymous') {
         return $this->json([]);
      }

      $data = json_decode($request->getContent(), true);

      $todo = new Todo();
      $todo->setContent($data['todo']['content']);
      $todo->setIsDone($data['todo']['isDone']);
      $todo->setFromUser($user);

       $manager->persist($todo);
       $manager->flush();

       return $this->json([]);
   }


   #[Route('/api/toggle-todo/{username}', name: 'app_toggle_todo', methods: ['POST'])]
   public function toggle_todo (User $user, Request $request, EntityManagerInterface $manager, TodoRepository $repository) : JsonResponse {

      if ($user->getUsername() === 'anonymous') {
         return $this->json([]);
      }

      $data = json_decode($request->getContent(), true);

      $todos = $repository->findBy(['fromUser' => $user, 'content' => $data['todo']['content']]);

      foreach ($todos as $todo) {
         $todo->setIsDone(!$todo->isIsDone());
         $manager->persist($todo);
      }
      $manager->flush();
      return $this->json([]);
   }


   #[Route('/api/delete-todo/{username}', name: 'app_delete_todo', methods: ['POST'])]
   public function delete_todo (User $user, Request $request, EntityManagerInterface $manager, TodoRepository $repository) : JsonResponse {

      if ($user->getUsername() === 'anonymous') {
         return $this->json([]);
      }

      $data = json_decode($request->getContent(), true);

      $todos = $repository->findBy(['fromUser' => $user, 'content' => $data['todo']['content']]);

      foreach ($todos as $todo) {
         $user->removeTodo($todo);
         $manager->remove($todo);
      }
      $manager->flush();
      return $this->json([]);
   }

}