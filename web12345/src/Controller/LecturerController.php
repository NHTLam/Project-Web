<?php

namespace App\Controller;

use App\Entity\Lecturer;
use App\Form\LecturerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use function PHPUnit\Framework\throwException;

#[Route('/lecturer')]
class LecturerController extends AbstractController
{
    #[Route('/ ', name: 'view_lecturer_list')]
    public function LecturerIndex(ManagerRegistry $managerRegistry) {
        $lecturers = $managerRegistry->getRepository(Lecturer::class)->findAll();
        return $this->render("lecturer/index.html.twig",
        [
            'lecturers' => $lecturers
        ]);
    }

    #[Route('/detail/{id}', name: 'view_lecturer_by_id')]
    public function LecturerDetail(ManagerRegistry $managerRegistry, $id) {
        $lecturer = $managerRegistry->getRepository(Lecturer::class)->find($id);
        return $this->render("lecturer/detail.html.twig",
        [
            'lecturer' => $lecturer
        ]);
    }

    #[Route('/delete/{id}', name: 'delete_lecturer')]
    public function LecturerDelete(ManagerRegistry $managerRegistry, $id) {
        $lecturer = $managerRegistry->getRepository(Lecturer::class)->find($id);
        if ($lecturer == null) {
            $this->addFlash("Error","Lecturer not found !");        
        } 
        else if (count($lecturer->getCourse()) >= 1 ) {
            $this->addFlash("Error","Can not delete this lecturer !");
        }
        else {
            $manager = $managerRegistry->getManager();
            $manager->remove($lecturer);
            $manager->flush();
            $this->addFlash("Success","Delete lecturer succeed  !");
        }
        return $this->redirectToRoute("view_lecturer_list");
    }

    #[Route('/add', name: 'add_lecturer')]
    public function LecturerAdd(Request $request) {
        $lecturer = new Lecturer;
        $form = $this->createForm(LecturerType::class,$lecturer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // code xu li upload anh
            // B1: tao 1 bien de lay du lieu anh upload tu form
            $image = $lecturer->getImage();
            
            // B2: tao ten moi cho anh => dam bao ten anh la duy nhat
        //  $imgName = $lecturer->getEmail() . '.' .  $lecturer->getAddress();
            $imgName = uniqid(); // unique id
            
            // B3: lay duoi (extension) cua file anh
            // Note: can xoa data type "string" trong getter va setter trong file Entity
            $imgExtension = $image->guessExtension();

            // B4: tao ten file hoan thien cho anh( ten file moi + duoi cu cua anh)
            $imageName = $imgName . '.' . $imgExtension;

            // B5: di chuyen file anh den thu muc chi dinh o trong project (nam o trong thu muc public)
            // Note1: can tao san thu muc chua anh trong thu muc public
            // Note2: cau hinh Parameter trong file services.yaml
            try {
                $image->move(
                    $this->getParameter('lecturer_image'), $imageName
                );

            } catch (FileException $e){
                throwException($e);
            }


            // B6: luu ten anh vao trong DB
            $lecturer->setImage($imageName);


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($lecturer);
            $manager->flush();
            $this->addFlash("Success","Add lecturer succeed !");
            return $this->redirectToRoute("view_lecturer_list");
        }
        return $this->renderForm("lecturer/add.html.twig",
        [
            'lecturerForm' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'edit_lecturer')]
    public function LecturerEdit(Request $request, ManagerRegistry $managerRegistry, $id) {
        $lecturer = $managerRegistry->getRepository(Lecturer::class)->find($id);
        if ($lecturer == null) {
            $this->addFlash("Error","Lecturer not found !");
            return $this->redirectToRoute("view_lecturer_list");        
        } else {
            $form = $this->createForm(LecturerType::class,$lecturer);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // Kiem ta xem nguoi dung co muon upload anh moi hay khong
                // neu co thi thuc hien code upload anhneu khong thi bo qua
                $imageFile = $form['image']->getData();
                if($imageFile != null){
                    // code xu li upload anh
                    // B1: tao 1 bien de lay du lieu anh upload tu form
                    $image = $lecturer->getImage();
                    
                    // B2: tao ten moi cho anh => dam bao ten anh la duy nhat
                //  $imgName = $lecturer->getEmail() . '.' .  $lecturer->getAddress();
                    $imgName = uniqid(); // unique id
                    
                    // B3: lay duoi (extension) cua file anh
                    // Note: can xoa data type "string" trong getter va setter trong file Entity
                    $imgExtension = $image->guessExtension();

                    // B4: tao ten file hoan thien cho anh( ten file moi + duoi cu cua anh)
                    $imageName = $imgName . '.' . $imgExtension;

                    // B5: di chuyen file anh den thu muc chi dinh o trong project (nam o trong thu muc public)
                    // Note1: can tao san thu muc chua anh trong thu muc public
                    // Note2: cau hinh Parameter trong file services.yaml
                    try {
                        $image->move(
                            $this->getParameter('lecturer_image'), $imageName
                        );

                    } catch (FileException $e){
                        throwException($e);
                    }

                    // B6: luu ten anh vao trong DB
                    $lecturer->setImage($imageName);
                }                

                $manager = $managerRegistry->getManager();
                $manager->persist($lecturer);
                $manager->flush();
                $this->addFlash("Success","Edit lecturer succeed !");
                return $this->redirectToRoute("view_lecturer_list");
            }
            return $this->renderForm("lecturer/edit.html.twig",
            [
                'lecturerForm' => $form
            ]);
        }   
    }
}
