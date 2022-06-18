<?php

namespace App\Controller;

use App\Entity\Classes;
use App\Form\ClassType;
use App\Repository\ClassesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/class')]
class ClassController extends AbstractController
{
    #[Route('/', name: 'view_class')]
    public function classIndex(ClassesRepository $classesRepository){
        $class = $classesRepository -> findAll();
        return $this -> render('class/index.html.twig', [
            'class' => $class
        ]);
    }

    #[Route('/delete/{id}', name: 'view_class_delete')]
    public function classDelete(ClassesRepository $classesRepository, $id){
        $class = $classesRepository -> find($id);
        if ($class == null){
            $this -> addFlash('Error', 'Class not found');
        }
        // elseif (count($class->getCourses()) >= 1) {
        //     $this -> addFlash("Error", "This person relate to other data, can not delete");
        // }
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
        $form = $this -> createForm(ClassType::class, $class);
        $form -> handleRequest($request);
        $title = "Add new";
        if($form -> isSubmitted() && $form->isValid()){
            $manager = $this -> getDoctrine() -> getManager();
            $manager -> persist($class);
            $manager -> flush();
            $this -> addFlash("Success","Add new class succeed !");
            return $this -> redirectToRoute('view_class');
        }
        return $this-> render("class/AddAndEdit.html.twig", [
            'classForm' => $form->createView(),
            'title' => $title
        ]);
    }

    #[Route('/edit/{id}', name: 'view_class_edit')]
    public function classEdit(Request $request, ClassesRepository $classesRepository, $id){
        $class = $classesRepository -> find($id);
        if ($class == null) {
            $this->addFlash("Error","Class not found !");
            return $this->redirectToRoute("view_class");        
        }
        else{
            $form = $this -> createForm(ClassType::class, $class);
            $form -> handleRequest($request);
            $title = "Update";

            if($form -> isSubmitted() && $form->isValid()){
                $manager = $this -> getDoctrine() -> getManager();
                $manager -> persist($class);
                $manager -> flush();
                $this -> addFlash("Success","Add new class succeed !");
                return $this -> redirectToRoute('view_class');
            }
            return $this-> render("class/AddAndEdit.html.twig", [
                'classForm' => $form->createView(),
                'title' => $title
            ]);
        }
    }
}
