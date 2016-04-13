<?php
namespace PbxG33k\MusicInfoBundle\Service\MusicBrainz;

use PbxG33k\MusicInfoBundle\Service\BaseService;
use PbxG33k\MusicInfoBundle\Service\Interfaces\IMusicService;
use MusicBrainz\HttpAdapters\GuzzleHttpAdapter;
use MusicBrainz\MusicBrainz;

class Service extends BaseService implements IMusicService
{
    protected $artist;

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
        if($config == []) {
            $config = $this->getConfig();
        }

        $apiClient = new MusicBrainz(new GuzzleHttpAdapter($this->getClient()));
        $apiClient->setUserAgent(
            $config['application_name'],
            $config['application_version'],
            $config['application_url']
        );
        $this->setApiClient($apiClient);
    }

    public function artist()
    {
        if(!$this->artist) {
            $this->artist = new Artist($this->getApiClient());
        }
        return $this->artist;
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