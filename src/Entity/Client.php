<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     attributes={"access_control"="is_granted('ROLE_ADMIN')"},
 *     collectionOperations={},
 *     itemOperations={}
 *     )
 * @ORM\Entity(
 *     repositoryClass="App\Repository\ClientRepository"
 * )
 */
class Client implements UserInterface
{
    /**
     * @var string The id of this phone
     *
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @Assert\NotBlank(message="This value should not be blank")
     * @Assert\Uuid()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="This value should not be blank")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="This value should not be blank")
     * @Assert\Email(message="Email address not valid")
     *
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This value should not be blank")
     *
     */
    private $password;

    /**
     * @ORM\Column(type="integer", length=10, nullable=true)
     * @Assert\Type("numeric")
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Assert\NotBlank(message="This value should not be blank")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="client", orphanRemoval=true)
     */
    private $Users;

    /**
     * Client constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->Users = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Client
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Client
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Client
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return Client
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Client
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return Client
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->Users;
    }

    /**
     * @param User $user
     * @return Client
     */
    public function addUser(User $user): self
    {
        if (!$this->Users->contains($user)) {
            $this->Users[] = $user;
            $user->setClient($this);
        }

        return $this;
    }

    /**
     * @param User $user
     * @return Client
     */
    public function removeUser(User $user): self
    {
        if ($this->Users->contains($user)) {
            $this->Users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getClient() === $this) {
                $user->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return string|void|null
     */
    public function getSalt()
    {

    }

    /**
     *
     */
    public function eraseCredentials()
    {

    }

}
