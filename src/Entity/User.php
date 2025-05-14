<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $firstname = null;

    #[ORM\Column(length: 100)]
    private ?string $lastname = null;

    #[ORM\Column(length: 20)]
    private ?string $userType = null;

    /**
     * @var Collection<int, RenduActivite>
     */
    #[ORM\OneToMany(targetEntity: RenduActivite::class, mappedBy: 'auteur')]
    private Collection $renduActivites;

    #[ORM\OneToMany(mappedBy: 'validateur', targetEntity: RenduActivite::class)]
    private Collection $rendusValides;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'emetteur')]
    private Collection $messages;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'destinataire')]
    private Collection $messagesDestinataire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getUserType(): ?string
    {
        return $this->userType;
    }

    public function setUserType(string $userType): static
    {
        $this->userType = $userType;
        return $this;
    }

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
        $this->userType = 'candidat';
        $this->renduActivites = new ArrayCollection();
        $this->rendusValides = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->messagesDestinataire = new ArrayCollection();
    }

    /**
     * @return Collection<int, RenduActivite>
     */
    public function getRenduActivites(): Collection
    {
        return $this->renduActivites;
    }

    public function getRendusValides(): Collection
    {
        return $this->rendusValides;
    }


    public function addRenduActivite(RenduActivite $renduActivite): static
    {
        if (!$this->renduActivites->contains($renduActivite)) {
            $this->renduActivites->add($renduActivite);
            $renduActivite->setAuteur($this);
        }

        return $this;
    }

    public function removeRenduActivite(RenduActivite $renduActivite): static
    {
        if ($this->renduActivites->removeElement($renduActivite)) {
            // set the owning side to null (unless already changed)
            if ($renduActivite->getAuteur() === $this) {
                $renduActivite->setAuteur(null);
            }
        }

        return $this;
    }
    public function addRenduValide(RenduActivite $renduActivite): static
    {
        if (!$this->rendusValides->contains($renduActivite)) {
            $this->rendusValides->add($renduActivite);
            $renduActivite->setValidateur($this);
        }
        return $this;
    }

    public function removeRenduValide(RenduActivite $renduActivite): static
    {
        if ($this->rendusValides->removeElement($renduActivite)) {
            if ($renduActivite->getValidateur() === $this) {
                $renduActivite->setValidateur(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setEmetteur($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getEmetteur() === $this) {
                $message->setEmetteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessagesDestinataire(): Collection
    {
        return $this->messagesDestinataire;
    }

    public function addMessagesDestinataire(Message $messagesDestinataire): static
    {
        if (!$this->messagesDestinataire->contains($messagesDestinataire)) {
            $this->messagesDestinataire->add($messagesDestinataire);
            $messagesDestinataire->setDestinataire($this);
        }

        return $this;
    }

    public function removeMessagesDestinataire(Message $messagesDestinataire): static
    {
        if ($this->messagesDestinataire->removeElement($messagesDestinataire)) {
            // set the owning side to null (unless already changed)
            if ($messagesDestinataire->getDestinataire() === $this) {
                $messagesDestinataire->setDestinataire(null);
            }
        }

        return $this;
    }

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Parcours $parcours = null;

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): static
    {
        $this->parcours = $parcours;
        return $this;
    }
}
