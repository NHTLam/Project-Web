<?php

namespace App\Controller;

use App\Entity\Assignment;
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

}

