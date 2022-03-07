<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
/**
 * @Vich\Uploadable
 */
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150)]
    private $nom;

    #[ORM\Column(type: 'string', length: 150)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $photo;

    
    /**
     * @Vich\UploadableField(mapping="photos", fileNameProperty="photo")
     */
    private $photofile;




    #[ORM\OneToMany(mappedBy: 'realisateur', targetEntity: Film::class)]
    private $films_realises;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $maj;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'acteurs')]
    private $films_joues;

    public function __construct()
    {
        $this->films_realises = new ArrayCollection();
        $this->films_joues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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
     * @return Collection<int, Film>
     */
    public function getFilmsRealises(): Collection
    {
        return $this->films_realises;
    }

    public function addFilmsRealise(Film $filmsRealise): self
    {
        if (!$this->films_realises->contains($filmsRealise)) {
            $this->films_realises[] = $filmsRealise;
            $filmsRealise->setRealisateur($this);
        }

        return $this;
    }

    public function removeFilmsRealise(Film $filmsRealise): self
    {
        if ($this->films_realises->removeElement($filmsRealise)) {
            // set the owning side to null (unless already changed)
            if ($filmsRealise->getRealisateur() === $this) {
                $filmsRealise->setRealisateur(null);
            }
        }

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
     * @return Collection<int, Film>
     */
    public function getFilmsJoues(): Collection
    {
        return $this->films_joues;
    }

    public function addFilmsJoue(Film $filmsJoue): self
    {
        if (!$this->films_joues->contains($filmsJoue)) {
            $this->films_joues[] = $filmsJoue;
            $filmsJoue->addActeur($this);
        }

        return $this;
    }

    public function removeFilmsJoue(Film $filmsJoue): self
    {
        if ($this->films_joues->removeElement($filmsJoue)) {
            $filmsJoue->removeActeur($this);
        }

        return $this;
    }
}
