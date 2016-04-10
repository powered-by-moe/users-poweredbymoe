<?php
namespace PoweredByMoe\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PoweredByMoe\ApiBundle\Entity\Client as OAuth2Client;

class LoadInitialOauth2Client implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $client = new OAuth2Client();
        $client->setRandomId('3bcbxd9e24g0gk4swg0kwgcwg4o8k8g4g888kwc44gcc0gwwk4');
        $client->setRedirectUris([]);
        $client->setSecret('4ok2x70rlfokc8g0wws8c8kwcokw80k44sg48goc0ok4w0so0k');
        $client->setAllowedGrantTypes(['password']);

        $manager->persist($client);
        $manager->flush();
    }
}