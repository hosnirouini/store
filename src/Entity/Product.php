<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\file\file;
use Symfony\Component\HttpFoundation\file\UploadedFile;
USE Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: ProductRepository::class)]
/**
 * @vich\Uploadable
 * */
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?bool $active = null;

    #[ORM\Column(nullable: true)]
    private ?bool $nonactive = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $rating = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $specified_order = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Category $category = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdat = null;



    #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrdersDetails::class)]
    private Collection $ordersDetails;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image1 = null;

    /**
    * @Vich\UploadableField(mapping="product",fileNameProperty="image1")
     * @var File
     */
        private $imageFile;

    /**
     * @Vich\UploadableField(mapping="product",fileNameProperty="image2")
     * @var File
     */
        private $imageFile2;

    /**
     * @Vich\UploadableField(mapping="product",fileNameProperty="image3")
     * @var File
     */
        private $imageFile3;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image3 = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Offers::class, mappedBy: 'products')]
    private Collection $offers;

    #[ORM\ManyToMany(targetEntity: Colors::class, inversedBy: 'products')]
    private Collection $colors;

    #[ORM\ManyToMany(targetEntity: Topsellers::class, mappedBy: 'products')]
    private Collection $topsellers;

    #[ORM\ManyToMany(targetEntity: Size::class, inversedBy: 'products')]
    private Collection $size;

    #[ORM\Column(nullable: true)]
    private ?float $oldprice = null;


    public function __construct()
    {
        $this->setCreatedat(new \DateTime());
        $this->images = new ArrayCollection();
        $this->ordersDetails = new ArrayCollection();
        $this->offers = new ArrayCollection();
        $this->colors = new ArrayCollection();
        $this->topsellers = new ArrayCollection();
        $this->size = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isNonactive(): ?bool
    {
        return $this->nonactive;
    }

    public function setNonactive(?bool $nonactive): self
    {
        $this->nonactive = $nonactive;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }




    public function getSpecifiedOrder(): ?string
    {
        return $this->specified_order;
    }

    public function setSpecifiedOrder(?string $specified_order): self
    {
        $this->specified_order = $specified_order;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeInterface $createdat): self
    {
        $this->createdat = $createdat;

        return $this;
    }
    public function __toString(): string
    {
        return (string) $this->name;
    }






    /**
     * @return Collection<int, OrdersDetails>
     */
    public function getOrdersDetails(): Collection
    {
        return $this->ordersDetails;
    }

    public function addOrdersDetail(OrdersDetails $ordersDetail): self
    {
        if (!$this->ordersDetails->contains($ordersDetail)) {
            $this->ordersDetails->add($ordersDetail);
            $ordersDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrdersDetail(OrdersDetails $ordersDetail): self
    {
        if ($this->ordersDetails->removeElement($ordersDetail)) {
            // set the owning side to null (unless already changed)
            if ($ordersDetail->getProduct() === $this) {
                $ordersDetail->setProduct(null);
            }
        }

        return $this;
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

    public function setImage2(?string $image2): self
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Offers>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offers $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->addProduct($this);
        }

        return $this;
    }

    public function removeOffer(Offers $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            $offer->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, colors>
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(colors $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors->add($color);
        }

        return $this;
    }

    public function removeColor(colors $color): self
    {
        $this->colors->removeElement($color);

        return $this;
    }

    /**
     * @return Collection<int, Topsellers>
     */
    public function getTopsellers(): Collection
    {
        return $this->topsellers;
    }

    public function addTopseller(Topsellers $topseller): self
    {
        if (!$this->topsellers->contains($topseller)) {
            $this->topsellers->add($topseller);
            $topseller->addProduct($this);
        }

        return $this;
    }

    public function removeTopseller(Topsellers $topseller): self
    {
        if ($this->topsellers->removeElement($topseller)) {
            $topseller->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Size>
     */
    public function getSize(): Collection
    {
        return $this->size;
    }


    public function addSize(size $size): self
    {
        if (!$this->size->contains($size)) {
            $this->size->add($size);
        }

        return $this;
    }

    public function removeSize(size $size): self
    {
        $this->size->removeElement($size);

        return $this;
    }

    public function getOldprice(): ?float
    {
        return $this->oldprice;
    }

    public function setOldprice(?float $oldprice): self
    {
        $this->oldprice = $oldprice;

        return $this;
    }



}
