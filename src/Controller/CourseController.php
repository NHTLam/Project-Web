<?php

namespace App\Controller;

use App\Entity\Courses;
use App\Form\CourseType;
use App\Repository\CoursesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;	

#[Route('/course')]
class CourseController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/' , name: 'view_course' )]
    public function CourseIndex(CoursesRepository $coursesRepository){
        $course = $coursesRepository -> findAll();
        return $this -> render('course/index.html.twig',[
            'course' => $course
        ]);
    }

    #[Route('/view', name: 'view_course_detail')]
    public function CourseDetail(CoursesRepository $coursesRepository){
        $course = $coursesRepository ->findAll();
        if ($course == null) {
            $this->addFlash("Error","Course not found !");
            return $this->redirectToRoute("view_course");        
        } else {
            return $this -> render('course/detail.html.twig',[
                'course' => $course
            ]);
        }
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
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

    /**
     * @IsGranted("ROLE_ADMIN")
     */
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

    /**
     * @IsGranted("ROLE_ADMIN")
     */
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

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/id/asc', name: 'sort_id_ascending')]
    public function sortCourseIdAscending (CoursesRepository $coursesRepository) {
        $course = $coursesRepository->sortByIdAsc();
        return $this->render('course/index.html.twig',
        [
            'course' => $course
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/id/desc', name: 'sort_id_descending')]
    public function sortCourseIdDescending (CoursesRepository $coursesRepository) {
        $course = $coursesRepository->sortByIdDesc();
        return $this->render('course/index.html.twig',
        [
            'course' => $course
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/StartDate/asc', name: 'sort_start_date_ascending')]
    public function sortCourseStartDateAscending (CoursesRepository $coursesRepository) {
        $course = $coursesRepository->sortByStartDateAsc();
        return $this->render('course/index.html.twig',
        [
            'course' => $course
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/StartDate/desc', name: 'sort_start_date_descending')]
    public function sortCourseStartDateDescending (CoursesRepository $coursesRepository) {
        $course = $coursesRepository->sortByStartDateDesc();
        return $this->render('course/index.html.twig',
        [
            'course' => $course
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/EndDate/asc', name: 'sort_end_date_ascending')]
    public function sortCourseEndDateAscending (CoursesRepository $coursesRepository) {
        $course = $coursesRepository->sortByEndDateAsc();
        return $this->render('course/index.html.twig',
        [
            'course' => $course
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/EndDate/desc', name: 'sort_end_date_descending')]
    public function sortCourseEndDateDescending (CoursesRepository $coursesRepository) {
        $course = $coursesRepository->sortByEndDateDesc();
        return $this->render('course/index.html.twig',
        [
            'course' => $course
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('search', name: 'search_by_course_name')]
    public function searchCourseName (CoursesRepository $coursesRepository, Request $request) 
    {
        $keyword = $request->get('keyword');
        $course = $coursesRepository->searchByName($keyword);
        return $this->render('course/index.html.twig',
        [
            'course' => $course
        ]);
    }
}
