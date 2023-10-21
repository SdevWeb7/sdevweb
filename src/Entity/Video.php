<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
   #[ORM\Id]
   #[ORM\GeneratedValue]
   #[ORM\Column]
   private ?int $id = null;

   #[ORM\Column(length: 255)]
   private ?string $url = null;


   #[ORM\Column(length: 255)]
   private ?string $title = null;


   #[ORM\Column(length: 255)]
   private ?string $description = null;

   #[ORM\Column(length: 255, nullable: false)]
   private ?string $category = null;


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

   public function setDescription(string $description): static
   {
      $this->description = $description;

      return $this;
   }

   public function getTitle () : ?string {
      return $this -> title;
   }

   public function setTitle (?string $title) : void {
      $this -> title = $title;
   }

   public function getCategory(): ?string
   {
       return $this->category;
   }

   public function setCategory(?string $category): static
   {
       $this->category = $category;

       return $this;
   }


}
