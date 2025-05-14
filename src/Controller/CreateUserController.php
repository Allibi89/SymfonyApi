<?php

namespace App\Controller;

use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;



final class CreateUserController extends AbstractController
{
   public function __invoke(
       Request $request,
       SerializerInterface $serializer,
       UserFactory $userFactory,
       UserManager $userManager
   ): Response {
       $data = $serializer->deserialize($request->getContent(), User::class, 'json');
       $user = $userFactory->create($data->getEmail(), $data->getPassword(), $data->getGivenName(), $data->getFamilyName());
       $userManager->save($user, true);

       return $this->json($user);
   }
}
