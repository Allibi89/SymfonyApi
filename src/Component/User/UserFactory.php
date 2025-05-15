<?php

declare(strict_types=1);

namespace App\Component\User;

use App\Entity\MediaObject;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function create(string $email, string $password, string $givenName, ?string $familyName, ?MediaObject $image): User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        $user->setGivenName($givenName);
        $user->setFamilyName($familyName);
        $user->setImage($image);

        return $user;
    }
}