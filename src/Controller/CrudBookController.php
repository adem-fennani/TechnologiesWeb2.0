<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/crud/book')]
class CrudBookController extends AbstractController
{
    #[Route('/new', name: 'app_crud_book')]
    public function newBook(ManagerRegistry $doctrine, Request $request): Response
    {
        // Create instance of book
        $book = new Book();

        // Create interface
        $form = $this->createForm(BookType::class, $book);

        // Send interface to the user
        return $this->render("crud_book/form.html.twig",
        ["form"=>$form->createview()]);

        // Get date from form/interface
        $form = $form->handleRequest($request);

        // Check if the form is valid and submitted
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist();
            $em->flush();
            return $this->redirectToRoute("app_book_list");
        }
    }

    #[Route('/list', name: 'app_book_list')]
    public function listBook(BookRepository $repository): Response {
        
        $list = $repository->findAll();
        return $this->render("crud_book/list.html.twig",
        ["list"=>$list]);
    }
}
