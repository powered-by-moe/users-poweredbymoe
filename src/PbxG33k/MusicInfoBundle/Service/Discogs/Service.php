<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 13-Apr-16
 * Time: 22:16
 */

namespace PbxG33k\MusicInfoBundle\Service\Discogs;

use Discogs\ClientFactory;
use PbxG33k\MusicInfoBundle\Service\BaseService;
use PbxG33k\MusicInfoBundle\Service\Interfaces\IMusicService;

class Service extends BaseService implements IMusicService
{
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
        if(!$config) {
            $config = $this->getConfig();
        }
        $constructor = [
            'defaults' => [
                'headers' => [
                    'User-Agent' => $config['guzzle']['http']['user_agent']
                ]
            ]
        ];

        $this->setApiClient(ClientFactory::factory($constructor));

        if($config['throttle']) {
            $apiClient = $this->getApiClient();
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