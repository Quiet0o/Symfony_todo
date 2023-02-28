<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request,EntityManagerInterface $em): Response
    {
        $todo = new Todo();

        $form = $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $todo = $form->getData();
            $em->persist($todo);
            $em->flush();
            $em->flush();

            return $this->render('todo/index.html.twig', [
                'form' => $form->createView(),
                'controller_name' => 'TodoController',
            ]);
        }

        return $this->render('todo/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'TodoController',
        ]);
    }
}
