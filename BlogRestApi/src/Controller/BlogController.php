<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    private $serializerInterface;
    public function __construct(SerializerInterface $serializerInterface)
    {
        $this->serializerInterface = $serializerInterface;
    }
    //SQL : SELECT * FROM Blog
    #[Route('/', methods: ['GET'] ,name: 'view_all_blog')] 
    public function viewAllBlog (BlogRepository $blogRepository) {
        //lấy dữ liệu từ bảng Blog trong database
        $blogs = $blogRepository->findAll();
        //convert dữ liệu thành chuẩn json (api)
        $json = $this->serializerInterface->serialize($blogs,'json');
        //return 1 response chứa dữ liệu theo format json
        return new Response($json, Response::HTTP_OK, 
        [
            'content-type' => 'application/json'
        ]);
    }

    //SQL : SELECT * FROM Blog WHERE id = $id
    #[Route('/{id}', methods: ['GET'], name: 'view_blog_by_id')]
    public function viewBlogById ($id, BlogRepository $blogRepository) {
        $blog = $blogRepository->find($id);
        //TH1: Khong ton tai 
        if ($blog == null){
            return new Response("Blog not found", Response::HTTP_NOT_FOUND); //code = 404
        }
        //TH2: Co ton tai
        //convert dữ liệu thành chuẩn xml (api)
        $xml = $this->serializerInterface->serialize($blog,'xml');
        //return 1 response chứa dữ liệu theo format xml
        return new Response($xml, 200, 
        [
            'content-type' => 'application/xml'
        ]);
    }

    // Delete From Blog Where id = $id
    #[Route('/{id}', methods: ['DELETE'], name: 'delete_blog')]
    public function deleteBlog ($id, BlogRepository $blogRepository){
        $blog = $blogRepository->find($id);
        if($blog != null){
            $manage = $this->getDoctrine()->getManager();
            $manage->remove($blog);
            $manage->flush();
            return new Response(null, Response::HTTP_NO_CONTENT);
        } else {
            return new Response("Blog not found", 404);
        }
    }

    // Insert into 
    #[Route("/", methods: ['POST'], name: 'add_new_blog')]
    public function addBlog (Request $request /* ManagerRegistry $managerRegistry*/ ){
        // tao moi 1 object Blog
        $blog = new Blog;
        // decode du lieu tu Request cua client
        $data = json_decode($request->getContent(),true);
        // set du lieu tuong ung cho object su dung ham setter
        $blog->setAuthor($data['author']);
        $blog->setTitle($data['title']);
        $blog->setContent($data['content']);
        $blog->setDate(\DateTime::createFromFormat('Y-m-d', $data['date']));
        // luu du lieu tu object vao database
        $manager = $this->getDoctrine()->getManager();
        // $manager = $this->getRegistry()->getManager();
        $manager->persist($blog);
        $manager->flush();
        // tra ve Response cho client
        return new Response(null, Response::HTTP_CREATED); //code = 201
    }

    // UPDATE Blog SET ... WHERE id = $id
    #[Route('/{id}', methods: ['PUT'], name: 'edit_blog')]
    public function editBlog ($id, Request $request, ManagerRegistry $managerRegistry){
        // lay ra Blog can edit trong DB theo id
        $blog = $managerRegistry->getResponsitory(Blog::class)->find($id);
        if ($blog==null){
            return new Response("Blog not found", Response::HTTP_BAD_REQUEST); // code = 400
        }
        // decode request tu client
        $data = json_decode($request->getContent(),true);
        // su dung setter de set du lieu moi cho object Blog
        $blog->setAuthor($data['author']);
        $blog->setTitle($data['title']);
        $blog->setContent($data['content']);
        $blog->setDate(\DateTime::createFromFormat('Y-m-d', $data['date']));
        // luu du lieu vao trong DB
        $manager = $managerRegistry->getManager();
        $manager->persist($blog);
        $manager->flush();
        // tra reponse ve client 
        return new Response("Blog has been update successfully !", Response::HTTP_ACCEPTED); //code = 202
    }
}   
