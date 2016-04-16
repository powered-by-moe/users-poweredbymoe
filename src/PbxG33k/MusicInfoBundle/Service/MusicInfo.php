<?php
namespace PbxG33k\MusicInfoBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use PbxG33k\MusicInfoBundle\Service\Interfaces\IMusicService;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * Class MusicInfo
 *
 * @package PbxG33k\MusicInfoBundle\Service
 */
class MusicInfo
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $services;
    protected $config;

    /**
     * Supported Services
     * @var array
     */
    protected $supportedServices = [];

    public function __construct($config)
    {
        $this->config = $config;

        $this->services = new ArrayCollection();
        $this->setClient(
            new Client($config['defaults']['guzzle'])
        );

        if(isset($config['services'])) {
            foreach($config['services'] as $service) {
                $this->loadService($service, $config['init']);
                $this->supportedServices[] = $service;
            }
        } else {
            throw new InvalidConfigurationException("musicinfo.services is required");
        }

        return $this->getServices();
    }

    /**
     * @param ClientInterface $client
     *
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Load service
     *
     * @param $service
     * @param $init
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function loadService($service, $init = false)
    {
        $fqcn = implode('\\',['PbxG33k', 'MusicInfoBundle', 'Service', $service, 'Service']);
        if(class_exists($fqcn)) {
            /** @var BaseService $client */
            $client = new $fqcn();
            $client->setConfig($this->mergeConfig($service));
            $client->setClient($this->getClient());
            if($init == true) {
                $client->init();
            }
            $this->addService($client, $service);
        } else {
            throw new \Exception('Service class does not exist: '.$service);
        }
    }

    /**
     * Merge shared config with service specific configuration
     *
     * @param $service
     */
    public function mergeConfig($service)
    {
        $service = strtolower($service);
        if(isset($this->config[$service])) {
            $config = array_merge(
                $this->config[$service],
                $this->config['defaults']
            );
            return $config;
        } else {
            return $this->config['defaults'];
        }
    }

    /**
     * Load all services
     *
     * @return bool|ArrayCollection
     */
    public function loadServices()
    {
        foreach($this->supportedServices as $service) {
            $this->loadService($service);
        }

        return $this->getServices();
    }

    /**
     * @param IMusicService $service
     *
     * @return $this
     */
    public function addService(IMusicService $service, $key)
    {
        $this->services[$key] = $service;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    public function getService($key)
    {
        if(isset($this->services[$key])) {
            return $this->services[$key];
        } else {
            return null;
        }
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function removeService($key)
    {
        if(isset($this->services[$key])) {
            unset($this->services[$key]);
        }

        return $this;
    }

    /**
     * @return IMusicService
     */
    public function getPreferredService()
    {
        return $this->getService($this->config['preferred_order'][0]);
    }
}