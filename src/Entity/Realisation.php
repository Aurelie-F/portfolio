<?php

namespace App\Entity;

use App\Repository\RealisationRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=RealisationRepository::class)
 * @Vich\Uploadable
 */
class Realisation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo1;

    /**
     * @Vich\UploadableField(mapping="photo_file", fileNameProperty="photo1")
     * @var File|null
     */
    private $photo1File;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var Datetime|null
     */
    private $updatedPhoto1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo2;

    /**
     * @Vich\UploadableField(mapping="photo_file", fileNameProperty="photo2")
     * @var File|null
     */
    private $photo2File;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var Datetime|null
     */
    private $updatedPhoto2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo3;

    /**
     * @Vich\UploadableField(mapping="photo_file", fileNameProperty="photo3")
     * @var File|null
     */
    private $photo3File;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var Datetime|null
     */
    private $updatedPhoto3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto1(): ?string
    {
        return $this->photo1;
    }

    public function setPhoto1(?string $photo1): self
    {
        $this->photo1 = $photo1;

        return $this;
    }

    public function getPhoto2(): ?string
    {
        return $this->photo2;
    }

    public function setPhoto2(?string $photo2): self
    {
        $this->photo2 = $photo2;

        return $this;
    }

    public function getPhoto3(): ?string
    {
        return $this->photo3;
    }

    public function setPhoto3(?string $photo3): self
    {
        $this->photo3 = $photo3;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhoto1File(): ?File
    {
        return $this->photo1File;
    }

    /**
     * @param File|null $photo1File
     * @return Realisation
     */
    public function setPhoto1File(File $photo1File = null): self
    {
        $this->photo1File = $photo1File;
        if ($photo1File) {
            $this->updatedPhoto1 = new DateTime('now');
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhoto2File(): ?File
    {
        return $this->photo2File;
    }

    /**
     * @param File|null $photo2File
     * @return Realisation
     */
    public function setPhoto2File(File $photo2File = null): self
    {
        $this->photo2File = $photo2File;
        if ($photo2File) {
            $this->updatedPhoto2 = new DateTime('now');
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPhoto3File(): ?File
    {
        return $this->photo3File;
    }

    /**
     * @param File|null $photo3File
     * @return Realisation
     */
    public function setPhoto3File(File $photo3File = null): self
    {
        $this->photo3File = $photo3File;
        if ($photo3File) {
            $this->updatedPhoto3 = new DateTime('now');
        }

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedPhoto1(): ?DateTime
    {
        return $this->updatedPhoto1;
    }

    /**
     * @param DateTime|null $updatedPhoto1
     */
    public function setUpdatedPhoto1(?DateTime $updatedPhoto1): void
    {
        $this->updatedPhoto1 = $updatedPhoto1;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedPhoto2(): ?DateTime
    {
        return $this->updatedPhoto2;
    }

    /**
     * @param DateTime|null $updatedPhoto2
     */
    public function setUpdatedPhoto2(?DateTime $updatedPhoto2): void
    {
        $this->updatedPhoto2 = $updatedPhoto2;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedPhoto3(): ?DateTime
    {
        return $this->updatedPhoto3;
    }

    /**
     * @param DateTime|null $updatedPhoto3
     */
    public function setUpdatedPhoto3(?DateTime $updatedPhoto3): void
    {
        $this->updatedPhoto3 = $updatedPhoto3;
    }
}
