<?php

namespace App\Controller;

use App\Form\AnswerQType;
use App\Entity\Assignment;
use App\Form\FeedbackType;
use App\Form\AssignmentType;
use App\DataFixtures\Assigment;
use App\Repository\AssignmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/assignment')]
class AssigmentController extends AbstractController
{
    #[Route('/', name: 'view_assignment')]
    public function AssigmentIndex(AssignmentRepository $assignmentRepository)
    {
        $assignments = $assignmentRepository->findAll();
        return $this->render('assignment/index.html.twig',
        [
            'assignments' => $assignments
        ]);
    }

    #[Route('/detail/{id}', name: 'view_assignment_by_id')]
    public function AssignmentDetail(AssignmentRepository $assignmentRepository, $id)
    {
        $assignment = $assignmentRepository->find($id);
        return $this->render('assignment/detail.html.twig',
        [
            'assignment' => $assignment
        ]);
    }

    // /**
    //  * @IsGranted("ROLE_LECTURE")
    //  */
    #[Route('/delete/{id}', name: 'delete_assignment')]
    public function AssignmentDelete(AssignmentRepository $assignmentRepository, $id)
    {
        $assignment = $assignmentRepository->find($id);
        if ($assignment == null){
            $this->addFlash("Error", "Asssignment not found !");
        }
        else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($assignment);
            $manager->flush();
            $this->addFlash("Success", "Delete assigment succeed");   
        }
        return $this->redirectToRoute("view_assignment");
    }

    // /**
    //  * @IsGranted("ROLE_LECTURE")
    //  */
    #[Route('/add', name: 'add_assignment')]
    public function AssignmentAdd(Request $request)
    {
        $assignment = new Assignment;
        $form = $this->createForm(AssignmentType::class, $assignment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($assignment);
            $manager->flush();
            $this->addFlash("Success", "Add assignment succeed !");  
            return $this->redirectToRoute("view_assignment");
        }
        return $this->render('assignment/add.html.twig', 
        [
            'assignmentForm' => $form->createView() 
        ]);
    }

    #[Route('/edit/{id}', name: 'edit_assignment')]
    public function AssignmetEdit(Request $request, AssignmentRepository $assignmentRepository, $id)
    {
        $assignment = $assignmentRepository->find($id);
        if ($assignment == null) {
            $this->addFlash("Error", "Assignment not found !");
            return $this->redirectToRoute("view_assignment");
        }
        else{
            $form = $this->createForm(AssignmentType::class, $assignment);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($assignment);
                $manager->flush();
                $this->addFlash("Success", "Edit assignment succeed !");  
                return $this->redirectToRoute("view_assignment");
            }
        }
        return $this->renderform('assignment/edit.html.twig', 
        [
            'assignmentForm' => $form
        ]);

    }


    // #[Route('/answer/delete/{id}', name: 'delete_answer')]
    // public function AnswerDelete(AssignmentRepository $assignmentRepository, $id)
    // {
    //     $answer = $assignmentRepository->find($id);
    //     if ($answer == null){
    //         $this->addFlash("Error", "Asssignment not found !");
    //     }
    //     else {
    //         $manager = $this->getDoctrine()->getManager();
    //         $manager->remove($answer);
    //         $manager->flush();
    //         $this->addFlash("Success", "Delete answer succeed");   
    //     }
    //     return $this->redirectToRoute("view_assignment");
    // }

    #[Route('/answer/add/{id}', name: 'add_answer')]
    public function AnswerAdd(AssignmentRepository $assignmentRepository, Request $request, $id)
    {
        $answer = $assignmentRepository->find($id);
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
        return $this->render('assignment/add_answer.html.twig', 
        [
            'answerForm' => $form->createView()
        ]);
    }

    #[Route('/answer/edit/{id}', name: 'edit_answer')]
    public function AnswerEdit(AssignmentRepository $assignmentRepository, Request $request, $id)
    {
        $answer = $assignmentRepository->find($id);
        if ($answer == null) {
            $this->addFlash("Error", "Answer not found");
        }
        else
        {
            $form = $this->createForm(AnswerQType::class, $answer);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($answer);
                $manager->flush();
                $this->addFlash("Success", "Edit submit succeed");
                return $this->redirectToRoute('view_assignment');
            }
        }
        return $this->render('assignment/edit_answer.html.twig', [
            'answerForm' => $form ->createView()
        ]);
    }

    #[Route('/feedback/add/{id}', name: 'add_feedback')]
    public function FeedbackAdd(AssignmentRepository $assignmentRepository, Request $request, $id)
    {
        $feedback = $assignmentRepository->find($id);
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($feedback);
            $manager->flush();
            $this->addFlash("Success", "Submit feedback succeed");
            return $this->redirectToRoute('view_assignment');
        }
        return $this->render('assignment/add_feedback.html.twig', 
        [
            'feedbackForm' => $form->createView()
        ]);
    }

    #[Route('/feedback/edit/{id}', name: 'edit_feedback')]
    public function FeedbackEdit(AssignmentRepository $assignmentRepository, Request $request, $id)
    {
        $feedback = $assignmentRepository->find($id);
        if ($feedback == null) {
            $this->addFlash("Error", "Feedback not found");
        }
        else
        {
            $form = $this->createForm(FeedbackType::class, $feedback);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($feedback);
                $manager->flush();
                $this->addFlash("Success", "Edit feedback succeed");
                return $this->redirectToRoute('view_assignment');
            }
        }
        return $this->render('assignment/edit_feedback.html.twig', [
            'feedbackForm' => $form ->createView()
        ]);
    }

    #[Route('/feedback', name: 'view_feedback')]
    public function FeedbackIndex(AssignmentRepository $assignmentRepository)
    {
        $assignments = $assignmentRepository->findAll();
        return $this->render('assignment/index_feedback.html.twig',
        [
            'assignments' => $assignments
        ]);
    }

}
