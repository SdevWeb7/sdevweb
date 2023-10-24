<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\TodoController;
use App\Repository\TodoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TodoRepository::class)]
#[ApiResource(
   operations: [
      new GetCollection(controller: TodoController::class, normalizationContext: [
         'groups' => ['todo:item', 'todo:list']
      ]),
//      new Post(controller: TodoController::class, normalizationContext: [
//         'groups' => ['todo:item', 'todo:list']
//      ], security: 'is_granted("NOT_ANONYME", object)'),
   ])]
#[ApiFilter(SearchFilter::class, properties: ['content' => 'exact'])]
class Todo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([ 'todo:item', 'todo:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['todo:item', 'todo:list'])]
    private ?string $content = null;

    #[ORM\Column]
    #[Groups(['todo:item', 'todo:list'])]
    private ?bool $isDone = null;

    #[ORM\ManyToOne(inversedBy: 'todos')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $fromUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function isIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): static
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getFromUser(): ?User
    {
        return $this->fromUser;
    }

    public function setFromUser(?User $fromUser): static
    {
        $this->fromUser = $fromUser;

        return $this;
    }
}
