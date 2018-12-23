<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     attributes={"order"={"createdAt":"DESC"}},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 *     )
 *
 * @ApiFilter(
 *     SearchFilter::class, properties={
 *     "brand": "partial", "reference": "partial", "price": "partial", "color": "partial", "storage": "partial"
 * })
 *
 * @ORM\Entity(
 *     repositoryClass="App\Repository\PhoneRepository"
 * )
 */
class Phone
{
    /**
     * @var string The id of this phone
     *
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @Assert\NotBlank(message="This value should not be blank")
     * @Assert\Uuid()
     * @Groups({"read"})
     */
    private $id;

    /**
     *
     * @var string Brand of this phone
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This value should not be blank")
     */
    private $brand;

    /**
     * @var string The model of this phone
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This value should not be blank")
     */
    private $model;

    /**
     * @var string The color of this phone
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Type("alpha")
     */
    private $color;

    /**
     * @var string The storage of this phone
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type("numeric")
     */
    private $storage;

    /**
     * @var string The price of this phone
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type("numeric")
     */
    private $price;

    /**
     * @var \DateTime The creation date of this phone
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Assert\NotBlank(message="This value should not be blank")
     */
    private $createdAt;

    /**
     * @var \DateTime The update of this phone
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     *
     */
    private $updatedAt;

    /**
     * Phone constructor.
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
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return Phone
     */
    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return Phone
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Phone
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     * @return Phone
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     * @return Phone
     */
    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string|null $price
     * @return Phone
     */
    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStorage(): ?string
    {
        return $this->storage;
    }

    /**
     * @param string $storage
     */
    public function setStorage(string $storage): void
    {
        $this->storage = $storage;
    }

}
