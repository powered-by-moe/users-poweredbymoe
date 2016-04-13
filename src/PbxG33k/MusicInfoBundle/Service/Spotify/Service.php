<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 13-Apr-16
 * Time: 21:54
 */

namespace PbxG33k\MusicInfoBundle\Service\Spotify;

use PbxG33k\MusicInfoBundle\Service\BaseService;
use PbxG33k\MusicInfoBundle\Service\Interfaces\IMusicService;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

class Service extends BaseService implements IMusicService
{
    private $configKeys = ['client_id', 'client_secret', 'redirect_uri'];

    public function __construct()
    {
        throw new \Exception('Spotify Not Implemented');
    }

    /**
     * Service specific initializer
     *
     * Construct your API client in this method.
     * It is set to be the method that is called by Symfony's Service Loader
     *
     * @param array $config
     * @return mixed
     */
    public function init($config = [])
    {
        if (!$config || !is_array($config)) {
            throw new InvalidConfigurationException();
        }

        foreach ($this->configKeys as $key) {
            if (!isset($config[$key]) || $config[$key] == null) {
                throw new InvalidConfigurationException('Spotify configuration missing. ' . $key . ' is required');
            }
        }
    }

    public function artist()
    {
        // TODO: Implement artist() method.
    }

    public function album()
    {
        // TODO: Implement album() method.
    }

    public function song()
    {
        // TODO: Implement song() method.
    }

    public function track()
    {
        // TODO: Implement track() method.
    }
}