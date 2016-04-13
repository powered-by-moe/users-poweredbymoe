<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 13-Apr-16
 * Time: 23:27
 */

namespace PbxG33k\MusicInfoBundle\Service\MusicBrainz;

use MusicBrainz\MusicBrainz;
use PbxG33k\MusicInfoBundle\Service\Interfaces\IMusicServiceEndpoint;
use MusicBrainz\Filters\ArtistFilter;

class Artist implements IMusicServiceEndpoint
{
    /** @var  MusicBrainz */
    protected $apiService;
    
    public function __construct($apiService)
    {
        $this->apiService = $apiService;
    }

    public function getApiService()
    {
        return $this->apiService;
    }

    public function get($arguments)
    {
        // TODO: Implement get() method.
    }

    public function getComplete($arguments)
    {
        // TODO: Implement getComplete() method.
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function getByName($name)
    {
        return $this->getApiService()->search(new ArtistFilter([
            "artist" => $name
        ]));
    }

    public function getByGuid($guid)
    {
        // TODO: Implement getByGuid() method.
    }
}