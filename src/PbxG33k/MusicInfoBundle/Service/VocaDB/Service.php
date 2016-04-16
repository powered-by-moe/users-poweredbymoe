<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 13-Apr-16
 * Time: 20:24
 */

namespace PbxG33k\MusicInfoBundle\Service\VocaDB;

use PbxG33k\MusicInfoBundle\Service\BaseService;
use PbxG33k\MusicInfoBundle\Service\Interfaces\IMusicService;
use Pbxg33k\VocaDB\Client as VocaDBClient;

class Service extends BaseService implements IMusicService
{
    /**
     * {@inheritdoc}
     */
    public function init($config = null)
    {
        if(!$config) {
            $config = $this->getConfig()['guzzle'];
        }

        $this->setApiClient(new VocaDBClient(['guzzle' => $config]));
        $this->client = new VocaDBClient($config);
        $this->setInitialized();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function artist()
    {
        return $this->getApiClient()->artist;
    }

    /**
     * {@inheritdoc}
     */
    public function album()
    {
        return $this->getApiClient()->album;
    }

    /**
     * {@inheritdoc}
     */
    public function song()
    {
        return $this->getApiClient()->song;
    }

    /**
     * Aliases song
     * 
     */
    public function track()
    {
        return $this->song();
    }
}