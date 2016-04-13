<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 13-Apr-16
 * Time: 20:20
 */

namespace PbxG33k\MusicInfoBundle\Service\Interfaces;

use GuzzleHttp\ClientInterface;

interface IMusicService
{
    /**
     * @param ClientInterface $client
     *
     * @return mixed
     */
    public function setClient(ClientInterface $client);

    /**
     * @return ClientInterface
     */
    public function getClient();

    /**
     * @param $config
     * @return mixed
     */
    public function setConfig($config= null);

    /**
     * @return mixed
     */
    public function getConfig();

    /**
     * Set the API Library client
     *
     * @param $apiClient
     * @return mixed
     */
    public function setApiClient($apiClient);

    /**
     * Get the API Library client
     * @return mixed
     */
    public function getApiClient();
    
    /**
     * Service specific initializer
     *
     * Construct your API client in this method.
     * It is set to be the method that is called by Symfony's Service Loader
     *
     * @param array $config
     * @return mixed
     */
    public function init($config = []);

    /**
     * @return IMusicServiceEndpoint
     */
    public function artist();

    /**
     * @return IMusicServiceEndpoint
     */
    public function album();

    /**
     * @return IMusicServiceEndpoint
     */
    public function song();

    /**
     * @return IMusicServiceEndpoint
     */
    public function track();
}