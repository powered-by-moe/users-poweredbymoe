<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 13-Apr-16
 * Time: 22:38
 */

namespace PbxG33k\MusicInfoBundle\Service;

use GuzzleHttp\ClientInterface;
use PbxG33k\MusicInfoBundle\Service\Interfaces\IMusicService;

abstract class BaseService implements IMusicService
{
    /**
     * @var Client
     */
    protected $client;

    protected $apiClient;
    
    protected $config;

    protected $initialized = false;

    /**
     * @param ClientInterface $client
     *
     * @return mixed
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
     * @param mixed $apiClient
     * @return Service
     */
    public function setApiClient($apiClient)
    {
        $this->apiClient = $apiClient;

        return $this;
    }

    /**
     * @return VocaDBClient
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }
    
    public function setConfig($config = null)
    {
        $this->config = $config;
        
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function isInitialized()
    {
        return (bool)$this->initialized;
    }

    public function setInitialized()
    {
        $this->initialized = true;

        return $this;
    }
}