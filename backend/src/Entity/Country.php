<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 * @ORM\Table(name="country")
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"basic"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"basic"})
     */
    private $iso2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"basic"})
     */
    private $iso3;

    /**
     * @ORM\Column(type="float")
     * @Groups({"basic"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     * @Groups({"basic"})
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"basic"})
     */
    private $flag;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"basic"})
     */
    private $population;

    /**
     * @ORM\ManyToOne(targetEntity=Continent::class, inversedBy="countries", cascade={"persist"})
     */
    private $continent;

    /**
     * @ORM\ManyToMany(targetEntity=CountryRoutes::class, mappedBy="countrySource")
     */
    private $routes;

    /**
     * @ORM\OneToOne(targetEntity=CountryCases::class, cascade={"persist"})
     * @Groups({"basic"})
     */
    private $cases;

    public function __construct()
    {
        $this->routes = new ArrayCollection();
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

    public function getIso2(): ?string
    {
        return $this->iso2;
    }

    public function setIso2(?string $iso2): self
    {
        $this->iso2 = $iso2;

        return $this;
    }

    public function getIso3(): ?string
    {
        return $this->iso3;
    }

    public function setIso3(?string $iso3): self
    {
        $this->iso3 = $iso3;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getContinent(): ?Continent
    {
        return $this->continent;
    }

    public function setContinent(?Continent $continent): self
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * @return Collection|CountryRoutes[]
     */
    public function getRoutes(): Collection
    {
        return $this->routes;
    }

    public function addRoute(CountryRoutes $route): self
    {
        if (!$this->routes->contains($route)) {
            $this->routes[] = $route;
            $route->addCountrySource($this);
        }

        return $this;
    }

    public function removeRoute(CountryRoutes $route): self
    {
        if ($this->routes->removeElement($route)) {
            $route->removeCountrySource($this);
        }

        return $this;
    }

    /**
     * @return CountryCases|null
     */
    public function getCases(): ?CountryCases
    {
        return $this->cases;
    }

    /**
     * @param CountryCases|null $cases
     * @return Country
     */
    public function setCases(?CountryCases $cases): self
    {
        $this->cases = $cases;

        return $this;
    }
}
