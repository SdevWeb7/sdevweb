<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TodoController extends AbstractController {

   #[Route('/todos/{reactRouting}', name: 'app_todos', defaults: ['reactRouting' => null] )]
   public function todo () : Response {
      return $this -> render('todos/todos.html.twig');
   }

   #[Route('/me', name: 'app_me')]
   public function me () : JsonResponse {
      if (!$this->getUser()) {
         return $this->json([]);
      }
      return $this->json($this->getUser(), 200, [], ['groups' => 'api:me']);
   }

   #[Route('/all-todos', name: 'app_all_todos')]
   public function all_todos (TodoRepository $todoRepository, UserRepository $userRepository) : Response {

      $user = $this->getUser() ?? $userRepository->findOneBy(['username' => 'anonymous']);

      $todos = $todoRepository->findBy(['fromUser' => $user]);

      return $this->json($todos, 200, [], ['groups' => 'api:todos']);
   }


   #[Route('/add-todo', name: 'app_add_todo')]
   public function add_todo (Request $request, EntityManagerInterface $manager, SerializerInterface $serializer) : JsonResponse
   {
       if (!$this->getUser()) {
          return $this->json([]);
       }

       $todo = $serializer->deserialize($request->getContent(), Todo::class, 'json', ['groups' => 'api:add:todo']);
       $todo->setFromUser($this->getUser());

       $manager->persist($todo);
       $manager->flush();

       return $this->json([]);
   }


   #[Route('/toggle-todo', name: 'app_toggle_todo', methods: ['POST'])]
   public function toggle_todo (Request $request, EntityManagerInterface $manager, TodoRepository $repository) : JsonResponse {

      if (!$this->getUser()) {
         return $this->json([]);
      }

      $data = json_decode($request->getContent(), true);

      $todos = $repository->findBy(['fromUser' => $this->getUser(), 'content' => $data['content']]);

      foreach ($todos as $todo) {
         $todo->setIsDone(!$todo->isIsDone());
         $manager->persist($todo);
      }
      $manager->flush();
      return $this->json([]);
   }


   #[Route('/delete-todo', name: 'app_delete_todo', methods: ['POST'])]
   public function delete_todo (Request $request, EntityManagerInterface $manager, TodoRepository $repository) : JsonResponse {

      if (!$this->getUser()) {
         return $this->json([]);
      }

      $data = json_decode($request->getContent(), true);

      $todos = $repository->findBy(['fromUser' => $this->getUser(), 'content' => $data['content']]);

      foreach ($todos as $todo) {
         $this->getUser()->removeTodo($todo);
         $manager->remove($todo);
      }
      $manager->flush();
      return $this->json([]);
   }

}