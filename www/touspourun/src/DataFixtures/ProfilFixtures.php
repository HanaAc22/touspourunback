<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\User;
use App\Trait\FixturesTrait;

class ProfilFixtures extends AbstractFixture
{
    use FixturesTrait;
    protected function buildEntity(array $data): Profil
    {
        $profil = new Profil();

        $profil
            ->setFirstName($data['firstName'])
            ->setLastName($data['lastName'])
            ->setUserName($data['userName'])
            ->setDescription($data['description'])
            ->setPicture($data['picture'])
            ->setAdress($data['adress'])
            ->setZipCode($data['zipCode'])
            ->setCommon($data['common'])
            ->setRegistred($data['status'])
            ->setTeatchingLevel($data['teachingLevel'])
            ->setSiret($data['siret'])
            ->setAssoName($data['assoName'])
            ->setRegistred($data['registred'])
        ;


        return $profil;
    }

    public static function getReferenceName(): string
    {
        return 'profil';
    }
}

