<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class StudentController extends AbstractController
{
    

    #[Route('/student/{id}', name: 'view_student_by_id')]
    public function FeedbackIndex(StudentRepository $studentRepository, $id)
    {
        $student = $studentRepository->find($id);        
        return $this->render('student/detail.html.twig', 
        [
            'student' => $student
        ]);
    }
}
