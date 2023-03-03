<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class TodoController extends AbstractController
{
    #[Route('/', name: 'todos')]
    public function index(Request $request, EntityManagerInterface $em, TodoRepository $repository): Response
    {
        $todo = new Todo();

        $form = $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $todo = $form->getData();
            $em->persist($todo);
            $em->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('todo/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'TodoController',
            'todos' => $repository->findAll()
        ]);
    }

    #[Route('/remove/{id}', name: 'todo_remove')]
    public function remove(EntityManagerInterface  $em, int $id)
    {
        $em->remove($em->getRepository(Todo::class)->find($id));
        $em->flush();
        return $this->redirectToRoute('todos');
    }
}
