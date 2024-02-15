<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * I changed the request() method to index(). Because the previous naming is not helpful.
 * I separated request() into two method: index() and delete().
 */
class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user_index')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $users = $userRepository->findAll();

        $user = new User();
        $form = $this->createForm(CreateUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_user_index');
            }
            // @todo validator/error message if form is invalid.
        }

        return $this->render('user.html.twig', [
            'users' => $users,
            'userForm' => $form->createView(),
        ]);
    }

    #[Route('/user/delete/{id}', name: 'app_user_delete')]
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_user_index');
    }
}