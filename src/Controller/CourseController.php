<?php

namespace App\Controller;

use App\Entity\Courses;
use App\Form\CourseType;
use App\Repository\CoursesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/course')]
class CourseController extends AbstractController
{
    #[Route('/' , name: 'view_course' )]
    public function CourseIndex(CoursesRepository $coursesRepository){
        $course = $coursesRepository -> findAll();
        return $this -> render('course/index.html.twig',[
            'course' => $course
        ]);
    }

    #[Route('/delete/{id}', name: 'view_course_delete')]
    public function courseDelete($id){
        $course = $this -> getDoctrine() -> getRepository(Courses::class) -> find($id);
        if ($course == null){
            $this-> addFlash("Error", "Not Found");
        }
        else{
            $manager = $this -> getDoctrine() -> getManager();
            $manager -> remove($course);
            $manager -> flush();
            $this -> addFlash("Success","Delete course succeed !");
        }
        return $this -> redirectToRoute('view_course');
    }

    #[Route('/add', name: 'view_course_add')]
    public function courseAdd(Request $request){
        $course = new Courses;
        $form = $this -> createForm(CourseType::class, $course);
        $form -> handleRequest($request);
        $title = "Add new";
        if($form -> isSubmitted() && $form->isValid()){
            $manager = $this -> getDoctrine() -> getManager();
            $manager -> persist($course);
            $manager -> flush();
            $this -> addFlash("Success","Add new course succeed !");
            return $this -> redirectToRoute('view_course');
        }
        return $this -> render('course/AddOrEditCourse.html.twig',[
            'formCourse' => $form->createView(),
            'title' => $title
        ]);
    }

    #[Route('/edit/{id}' , name: 'view_course_edit')]
    public function courseEdit(Request $request, CoursesRepository $coursesRepository, $id){
        $course = $coursesRepository -> find($id);
        if ($course == null) {
            $this->addFlash("Error","Course not found !");
            return $this->redirectToRoute("view_course");        
        } else {
            $form = $this -> createForm(CourseType::class, $course);
            $form -> handleRequest($request);
            $title = "Edit";
            if($form -> isSubmitted() && $form->isValid()){
                $manager = $this -> getDoctrine() -> getManager();
                $manager -> persist($course);
                $manager -> flush();
                $this -> addFlash("Success","Edit course succeed !");
                return $this -> redirectToRoute('view_course');
            }
            return $this -> render('course/AddOrEditCourse.html.twig',[
                'formCourse' => $form->createView(),
                'title' => $title
            ]);
        }
    }
}
