<?php

namespace App\DataFixtures;

use App\Entity\User;

class UserFixtures extends AbstractFixture
{
    protected function buildEntity(array $data): User
    {
        $user = new User();
        $user->setEmail($data['email'])
            ->setRoles($data['roles'])
            ->setPassword(password_hash($data['password'], PASSWORD_DEFAULT))
        ;
        return $user;
    }
    public static function getReferenceName(): string
    {
        return 'user';
    }
}
