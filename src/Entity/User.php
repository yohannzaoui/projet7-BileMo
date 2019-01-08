<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Annotation\UserAware;
use App\Controller\Api\AddUserController;

/**
 * @UserAware(userFieldName="client_id")
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     attributes={"access_control"="is_granted('ROLE_USER')"},
 *     itemOperations={"get","delete",
 *     "post_publication"={
 *     "method"="POST",
 *     "path"="/api/users",
 *     "controller"=AddUserController::class}})
 *
 * @ApiFilter(
 *     SearchFilter::class, properties={"name": "partial"}
 *     )
 *
 * @ORM\Entity(
 *     repositoryClass="App\Repository\UserRepository"
 *     )
 */
class User
{
    /**
     * @var string The id of this phone
     *
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @Assert\NotBlank()
     * @Assert\Uuid()
     * @Groups({"read","write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Groups({"read","write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="This value should not be blank")
     * @Assert\Email(message="Email address not valid")
     * @Groups({"read","write"})
     */
    private $email;

    /**
     * @ORM\Column(type="integer", length=10, nullable=true)
     * @Assert\Type("numeric")
     * @Groups({"read","write"})
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read","write"})
     */
    private $createdAt;

    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="Users")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     *
     */
    private $client;

    /**
     * User constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

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
     * @param string|null $phoneNumber
     * @return User
     */
    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }



    /**
     * @param Client|null $client
     * @return User
     */
    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt() :\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
