<?php

namespace App\Entity;

use App\Repository\SliderImagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\file\file;
use Symfony\Component\HttpFoundation\file\UploadedFile;
USE Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: SliderImagesRepository::class)]
/**
 * @vich\Uploadable
 * */
class SliderImages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image1 = null;

    /**
     * @Vich\UploadableField(mapping="product",fileNameProperty="image1")
     * @var File
     */
    private $imageFile1;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image2 = null;

    /**
     * @Vich\UploadableField(mapping="product",fileNameProperty="image1")
     * @var File
     */
    private $imageFile2;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image3 = null;

    /**
     * @Vich\UploadableField(mapping="product",fileNameProperty="image1")
     * @var File
     */
    private $imageFile3;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image4 = null;

    /**
     * @Vich\UploadableField(mapping="product",fileNameProperty="image1")
     * @var File
     */
    private $imageFile4;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(?string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): self
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getImage4(): ?string
    {
        return $this->image4;
    }

    public function setImage4(?string $image4): self
    {
        $this->image4 = $image4;

        return $this;
    }


    /**
     * @return string|null
     */
    public function  getImage(): ?String
    {
        return $this->image1;
    }

    /**
     * @param  string|null
     */
    public function  setImage(?string $image): self
    {
        $this->image1 = $image;
        return $this;
    }
    /**
     * @return File|null
     */
    public function  getImageFile(): ?File
    {
        return $this->imageFile;
    }
    /**
     * @param  File|null $imageFile
     */
    public function  setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

    }



}
