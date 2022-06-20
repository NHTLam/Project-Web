<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class StudentController extends AbstractController
{
    

    #[Route('/', name: 'view_student')]
    public function FeedbackIndex(StudentRepository $studentRepository)
    {
        $students = $studentRepository->findAll();        
        return $this->render('student/detail.html.twig', 
        [
            'students' => $students
        ]);
    }
}
