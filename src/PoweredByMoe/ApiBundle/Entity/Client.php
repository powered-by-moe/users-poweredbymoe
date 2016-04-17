<?php
namespace PoweredByMoe\ApiBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table("oauth2_clients")
 * @ORM\Entity
 */
class Client extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * The application this client belongs to
     *
     * @var Application
     *
     * @ORM\ManyToOne(targetEntity="PoweredByMoe\ApiBundle\Entity\Application", inversedBy="clients")
     * @ORM\JoinColumn(name="application_id", referencedColumnName="id")
     */
    protected $application;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param Application $application
     *
     * @return Client
     */
    public function setApplication(Application $application)
    {
        $this->application = $application;

        return $this;
    }


}