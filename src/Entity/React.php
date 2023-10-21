<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\ReactController;
use App\Repository\ReactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
   operations: [
      new Get(controller: ReactController::class, normalizationContext: [
         'groups' => 'react:item'
      ], security: 'is_granted("REACT_VOTER", object)'),
      new GetCollection(normalizationContext: [
         'groups' => 'react:list'
      ], security: 'is_granted("IS_AUTHENTICATED_FULLY")'),
   ], order: ['title' => 'DESC'], paginationItemsPerPage: 4,
)]
#[ApiFilter(SearchFilter::class, properties: ['title' => 'exact'])]
#[ORM\Entity(repositoryClass: ReactRepository::class)]
class React
{
   #[ORM\Id]
   #[ORM\GeneratedValue]
   #[ORM\Column]
   #[Groups(['react:item', 'react:list'])]
   private ?int $id = null;

   #[ORM\Column(length: 255)]
   #[Groups(['react:item', 'react:list'])]
   private ?string $url = null;

   #[ORM\Column(length: 255)]
   #[Groups(['react:item', 'react:list'])]
   private ?string $title = null;

   #[ORM\Column(length: 255)]
   #[Groups(['react:item', 'react:list'])]
   private ?string $description = null;


   public function getId(): ?int
   {
      return $this->id;
   }

   public function getUrl(): ?string
   {
      return $this->url;
   }

   public function setUrl(string $url): static
   {
      $this->url = $url;

      return $this;
   }

   public function getDescription(): ?string
   {
      return $this->description;
   }

   public function setDescription(string $description): static {
      $this -> description = $description;

      return $this;
   }

   public function getTitle () : ?string {
      return $this -> title;
   }

   public function setTitle (?string $title) : void {
      $this -> title = $title;
   }

}