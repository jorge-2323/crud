<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;




class HomeController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'crud_show')]

    public function show(): Response
    {
        $users = $this->em->getRepository(User::class)->findAll();
        return $this->render('home/index.html.twig', [
            'users' => $users, 
        ]);
    }

    #[Route('/crud/add', name: 'crud_add')]
    public function add(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user, [
            'is_edit' => false,
        ]); 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $campos = $form->getData();
                $user->setName($campos->getName());
                $user->setLastname($campos->getLastname());
                $user->setEmail($campos->getEmail());
                $user->setPhone($campos->getPhone());

                $this->em->persist($user);
                $this->em->flush();
                flash()->success('Usuario registrado correctamente');
                return $this->redirectToRoute('crud_show'); 
            } catch (\Exception $e) {
                flash()->danger('Ocurrio un error al guardar el usuario');
                return $this->redirectToRoute('crud_add');
            }
        } else {
            return $this->render('home/add.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    #[Route('/crud/update/{id}', name: 'crud_update')]
    public function update(int $id, Request $request): Response
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if (!$user){
            throw $this->createNotFoundException(
                'No se encontro el registro con el id' . $id
            );
        }
        $form = $this->createform(UserFormType::class, $user, [
            'is_edit' => false,
        ]);
        $form ->handleRequest($request);
        if ($form ->isSubmitted() && $form->isValid()) {
            try {
                $this->em->flush();
                flash()->success('Usuario actualizado correctamente');
                return $this->redirectToRoute('crud_show', ['id' => $id]);
            } catch (\Exception $e) {
                flash()->danger('Ocurrio un error al guardar el usuario');
                return $this->redirectToRoute('crud_update', ['id' => $id]);
            }
        } else{
            return $this->render('home/update.html.twig', [
                'form' => $form->createView(),
                'user' => $user,
            ]);
        }
    }

    #[Route('/crud/delete/{id}', name: 'crud_delete')]

    public function delete(int $id): Response
    {
        $user = $this->em->getRepository(User::class)->find($id);
        if (!$user){
            throw $this->createNotFoundException(
                'No se encontro el registro con el id' . $id
            );
        }
        $this->em->remove($user);
        $this->em->flush();
        flash()->success('Usuario eliminado correctamente');
        return $this->redirectToRoute('crud_show');
    }
}
