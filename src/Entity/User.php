<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['username', 'email'])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 40)]
    private ?string $username = null;

   #[ORM\Column(length: 180, unique: true)]
   #[Assert\NotBlank]
   #[Assert\Length(min: 3, max: 40)]
   #[Assert\Email]
   private ?string $email = null;

   #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'fromUser', targetEntity: Like::class, orphanRemoval: true)]
    private Collection $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }
    public function addRole (string $role) : static {
       $this->roles[] = $role;
       return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

   public function getEmail () : ?string {
      return $this -> email;
   }

   public function setEmail (?string $email) : void {
      $this -> email = $email;
   }

   public function eraseCredentials () : void {
      $this->password = '';
   }

   public function isVerified(): bool
   {
       return $this->isVerified;
   }

   public function setIsVerified(bool $isVerified): static
   {
       $this->isVerified = $isVerified;

       return $this;
   }

   /**
    * @return Collection<int, Like>
    */
   public function getLikes(): Collection
   {
       return $this->likes;
   }

   public function addLike(Like $like): static
   {
       if (!$this->likes->contains($like)) {
           $this->likes->add($like);
           $like->setFromUser($this);
       }

       return $this;
   }

   public function removeLike(Like $like): static
   {
       if ($this->likes->removeElement($like)) {
           // set the owning side to null (unless already changed)
           if ($like->getFromUser() === $this) {
               $like->setFromUser(null);
           }
       }

       return $this;
   }
}
