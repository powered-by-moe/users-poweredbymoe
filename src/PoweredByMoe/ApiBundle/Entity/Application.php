<?php

namespace PoweredByMoe\ApiBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="PoweredByMoe\ApiBundle\Repository\ApplicationRepository")
 */
class Application
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=255, unique=true)
     */
    private $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="version", type="float", nullable=true)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="homepage_url", type="string", length=255)
     */
    private $homepageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="support_url", type="string", length=255, nullable=true)
     */
    private $supportUrl;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="PoweredByMoe\ApiBundle\Entity\Client", mappedBy="application")
     */
    private $clients;

    /**
     * The owner of this application
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     *
     * @return Application
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Application
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set version
     *
     * @param float $version
     *
     * @return Application
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return float
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set homepage
     *
     * @param string $homepageUrl
     *
     * @return Application
     */
    public function setHomepageUrl($homepageUrl)
    {
        $this->homepageUrl = $homepageUrl;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return string
     */
    public function getHomepageUrl()
    {
        return $this->homepageUrl;
    }

    /**
     * Set supportUrl
     *
     * @param string $supportUrl
     *
     * @return Application
     */
    public function setSupportUrl($supportUrl)
    {
        $this->supportUrl = $supportUrl;

        return $this;
    }

    /**
     * Get supportUrl
     *
     * @return string
     */
    public function getSupportUrl()
    {
        return $this->supportUrl;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Application
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     *
     * @return Application
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;

        return $this;
    }

}

