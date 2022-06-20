<?php

namespace App\Controller;

use App\Entity\AnswerQ;
use App\Form\AnswerType;
use App\Form\AnswerQType;
use App\Repository\AnswerQRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/answer')]
class AnswerQController extends AbstractController
{
    #[Route('/add', name: 'add_answer')]
    public function AnswerAdd(Request $request)
    {
        $answer = new AnswerQ;
        $form = $this->createForm(AnswerQType::class, $answer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($answer);
            $manager->flush();
            $this->addFlash("Success", "Submit answer succeed");
            return $this->redirectToRoute('view_assignment');
        }
        return $this->render('answer_q/add.html.twig', 
        [
            'answerForm' => $form->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'edit_answer')]
    public function AnswerEdit(AnswerQRepository $answerQRepository, Request $request, $id)
    {
        $answer = $answerQRepository->find($id);
        if ($answer == null) {
            $this->addFlash("Error", "Answer not found");
        }
        else
        {
            $form = $this->createForm(AnswerType::class, $answer);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($answer);
                $manager->flush();
                $this->addFlash("Success", "Edit submit succeed");
                return $this->redirectToRoute('view_assignment');
            }
        }
        return $this->render('answer_q/edit.html.twig', [
            'answerForm' => $form
        ]);
    }
}
