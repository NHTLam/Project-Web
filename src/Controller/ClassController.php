<?php

namespace App\Controller;

use App\Entity\Classes;
use App\Entity\Courses;
use App\Form\ClassType;
use App\Repository\ClassesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;	
use function PHPUnit\Framework\throwException;

/**
 * @IsGranted("ROLE_ADMIN")
 */
#[Route('/class')]
class ClassController extends AbstractController
{
    #[Route('/', name: 'view_class')]
    public function classIndex(ClassesRepository $classesRepository){
        $class = $classesRepository -> findAll();
        $course = $this -> getDoctrine() -> getRepository(Courses::class) -> findAll();
        return $this -> render('class/index.html.twig', [
            'class' => $class,
            'course' => $course
        ]);
    }

    #[Route('/delete/{id}', name: 'view_class_delete')]
    public function classDelete(ClassesRepository $classesRepository, $id){
        $class = $classesRepository -> find($id);
        if ($class == null){
            $this -> addFlash('Error', 'Class not found');
        }
        else{
            $manager = $this -> getDoctrine() -> getManager();
            $manager->remove($class);
            $manager->flush();
            $this -> addFlash("Success","Delete class succeed !");
        }
        return $this->redirectToRoute('view_class');
    }

    #[Route('/add', name: 'view_class_add')]
    public function classAdd(Request $request){
        $class = new Classes;
        $course = $this -> getDoctrine() -> getRepository(Courses::class) -> findAll();
        $form = $this -> createForm(ClassType::class, $class);
        $form -> handleRequest($request);
        $title = "Add new";
        if($form -> isSubmitted() && $form->isValid()){
            $createFile = $form['student'] -> getData();
            if ($createFile != null){
                $file = $class->getStudent();
                $fileName = uniqid();
                $fileExtension = $file->guessExtension();
                $fileFullName = $fileName.".".$fileExtension;
                try{
                    $file-> move(
                        $this -> getParameter('student_file'), $fileName
                    );
                }catch(FileException $e){
                    throwException($e);
                }
                $class-> setStudent($fileFullName);
            }
            $manager = $this -> getDoctrine() -> getManager();
            $manager -> persist($class);
            $manager -> flush();
            $this -> addFlash("Success","Add new class succeed !");
            return $this -> redirectToRoute('view_class');
        }
        return $this-> render("class/AddAndEdit.html.twig", [
            'classForm' => $form->createView(),
            'title' => $title,
            'course' => $course
        ]);
    }

    #[Route('/edit/{id}', name: 'view_class_edit')]
    public function classEdit(Request $request, ClassesRepository $classesRepository, $id){
        $class = $classesRepository -> find($id);
        $course = $this -> getDoctrine() -> getRepository(Courses::class) -> findAll();
        if ($class == null) {
            $this->addFlash("Error","Class not found !");
            return $this->redirectToRoute("view_class");        
        }
        else{
            $form = $this -> createForm(ClassType::class, $class);
            $form -> handleRequest($request);
            $title = "Update";

            if($form -> isSubmitted() && $form->isValid()){
                $createFile = $form['student'] -> getData();
                if ($createFile != null){
                    $file = $class->getStudent();
                    $fileName = uniqid();
                    $fileExtension = $file->guessExtension();
                    $fileFullName = $fileName.".".$fileExtension;
                    try{
                        $file-> move(
                            $this -> getParameter('student_file'), $fileName
                        );
                    }catch(FileException $e){
                        throwException($e);
                    }
                    $class-> setStudent($fileFullName);
                }
                $manager = $this -> getDoctrine() -> getManager();
                $manager -> persist($class);
                $manager -> flush();
                $this -> addFlash("Success","Update class succeed !");
                return $this -> redirectToRoute('view_class');
            }
            return $this-> render("class/AddAndEdit.html.twig", [
                'classForm' => $form->createView(),
                'title' => $title,
                'course' => $course
            ]);
        }
    }

    #[Route('/id/asc', name: 'sort_class_id_ascending')]
    public function sortClassIdAscending (ClassesRepository $classesRepository) {
        $class = $classesRepository->sortByIdAsc();
        return $this -> render('class/index.html.twig', [
            'class' => $class
        ]);
    }

    #[Route('/id/desc', name: 'sort_class_id_descending')]
    public function sortClassIdDescending (ClassesRepository $classesRepository) {
        $class = $classesRepository->sortByIdDesc();
        return $this -> render('class/index.html.twig', [
            'class' => $class
        ]);
    }

    #[Route('/name/asc', name: 'sort_class_name_ascending')]
    public function sortClassNameAscending (ClassesRepository $classesRepository) {
        $class = $classesRepository->sortByNameAsc();
        return $this -> render('class/index.html.twig', [
            'class' => $class
        ]);
    }

    #[Route('/name/desc', name: 'sort_class_name_descending')]
    public function sortClassNameDescending (ClassesRepository $classesRepository) {
        $class = $classesRepository->sortByNameDesc();
        return $this -> render('class/index.html.twig', [
            'class' => $class
        ]);
    }

    #[Route('/StdQuantity/asc', name: 'sort_class_StdQuantity_ascending')]
    public function sortClassStdQuantityAscending (ClassesRepository $classesRepository) {
        $class = $classesRepository->sortByNumberOfStudentAsc();
        return $this -> render('class/index.html.twig', [
            'class' => $class
        ]);
    }

    #[Route('/StdQuantity/desc', name: 'sort_class_StdQuantity_descending')]
    public function sortClassStdQuantityDescending (ClassesRepository $classesRepository) {
        $class = $classesRepository->sortByNumberOfStudentDesc();
        return $this -> render('class/index.html.twig', [
            'class' => $class
        ]);
    }

    #[Route('search', name: 'search_by_class_name')]
    public function searchClassName (ClassesRepository $classesRepository, Request $request) 
    {
        $keyword = $request->get('keyword');
        $class = $classesRepository->searchByName($keyword);
        return $this -> render('class/index.html.twig', [
            'class' => $class
        ]);
    }
}
