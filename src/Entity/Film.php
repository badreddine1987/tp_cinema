<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FilmRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
/**
 * @Vich\Uploadable
 */
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $titre;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'films')]
    private $categorie;

    #[ORM\ManyToOne(targetEntity: Artiste::class, inversedBy: 'films_realises')]
    #[ORM\JoinColumn(nullable: false)]
    private $realisateur;

    #[ORM\Column(type: 'string', length: 255)]
    private $photo;

    /**
     * @Vich\UploadableField(mapping="photos", fileNameProperty="photo")
     */
    private $photofile;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $maj;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'films_joues')]
    private $acteurs;

    public function __construct()
    {
        $this->film = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getRealisateur(): ?Artiste
    {
        return $this->realisateur;
    }

    public function setRealisateur(?Artiste $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of maj
     */ 
    public function getMaj()
    {
        return $this->maj;
    }

    /**
     * Set the value of maj
     *
     * @return  self
     */ 
    public function setMaj($maj)
    {
        $this->maj = $maj;

        return $this;
    }

    /**
     * Get the value of photofile
     */ 
    public function getPhotofile()
    {
        return $this->photofile;
    }

    /**
     * Set the value of photofile
     *
     * @return  self
     */ 
    public function setPhotofile($photofile)
    {
        $this->photofile = $photofile;

        if (null !== $photofile) {
            $this->maj = new \DateTimeImmutable();
            
        }
        
                return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Artiste $acteur): self
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs[] = $acteur;
        }

        return $this;
    }

    public function removeActeur(Artiste $acteur): self
    {
        $this->acteurs->removeElement($acteur);

        return $this;
    }
}
