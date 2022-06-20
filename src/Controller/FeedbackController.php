<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use App\Repository\FeedbackRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/feedback')]
class FeedbackController extends AbstractController
{
    #[Route('/', name: 'view_feedback')]
    public function FeedbackIndex(FeedbackRepository $feedbackRepository)
    {
        $feedbacks = $feedbackRepository->findAll();        
        return $this->render('feedback/index.html.twig', [
            'feedbacks' => $feedbacks
        ]);
    }

    #[Route('/detail/{id}', name: 'view_feedback_by_id')]
    public function FeedbackDetail(FeedbackRepository $feedbackRepository, $id)
    {
        $feedback = $feedbackRepository->find($id);
        return $this->render('feedback/detail.html.twig',
        [
            'feedback' => $feedback
        ]);
    }

    #[Route('/delete/{id}', name: 'delete_feedback')]
    public function FeedbackDelete(FeedbackRepository $feedbackRepository, $id)
    {
        $feedback = $feedbackRepository->find($id);
        if ($feedback == null) {
            $this->addFlash("Error", "Feedback not found");
        }
        else 
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($feedback);
            $manager->flush();
            $this->addFlash("Success", "Delete feedback succeed");
        }
        return $this->redirect('view_assignment_by_id');        
    }

    #[Route('/add', name: 'add_feedback')]
    public function FeedbackAdd(Request $request)
    {
        $feedback = new Feedback;
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            $this->addFlash("Success", "Feedback succeed");
            return $this->redirectToRoute('view_assignment');
        }
        return $this->render("feedback/add.html.twig",
        [
            'feedbackForm' => $form->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'edit_feedback')]
    public function FeedbackEdit(Request $request, FeedbackRepository $feedbackRepository, $id)
    {
        $feedback = $feedbackRepository->find($id);
        if ($feedback == null) {
            $this->addFlash("Error", "Feedback not found");
            return $this->redirectToRoute('view_assignment');
        }
        else
        {
            $form = $this->createForm(FeedbackType::class, $feedback);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $manager = $this->getDoctrine()->getManager();
                $manager->flush();
                $this->addFlash("Success", "Edit feedback succeed");
                return $this->redirectToRoute('view_feedback');
            }
        }
        return $this->renderForm("feedback/edit.html.twig", 
        [
            'feedbackForm' => $form
        ]);
    }
}
