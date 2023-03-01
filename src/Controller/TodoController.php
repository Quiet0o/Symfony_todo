<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request,EntityManagerInterface $em,ManagerRegistry $doctrine): Response
    {
        $todo = new Todo();

        $form = $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);

        $repository = $doctrine->getRepository(Todo::class);
        $todos = $repository->findAll();

        if (!$todos) {
            dump('No todos found');
        }


        if ($form->isSubmitted() && $form->isValid()) {

            $todo = $form->getData();
            $em -> persist($todo);
            $em -> flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('todo/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'TodoController',
            'todos' => $todos
        ]);
    }
}
