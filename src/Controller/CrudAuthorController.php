<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/crud/author")]
class CrudAuthorController extends AbstractController
{
    #[Route('/list', name: 'app_crud_author')]
    public function list(AuthorRepository $repository): Response {
        
        $list = $repository->findAll();
        return $this->render("crud_author/list.html.twig",
        ["list"=>$list]);
    }

    // Method to search an author by name
    #[Route('/search/{name}', name: 'app_crud_search')]
    public function searchByName(AuthorRepository $repository, Request $request) : Response {
        // Get the data name from the request
        $name = $request->get("name");

        // Use a magic method to make a search by name
        $authors = $repository->findByName($name);
        // var_dump($authors);
        // die();
        return $this->render("crud_author/list.html.twig",
        ["list"=>$authors]);
    }

    // Method to insert a new author
    #[Route('/new', name: 'app_crud_create')]
    public function newAuthor(ManagerRegistry $doctrine): Response {

        // Create an instance from the class author
        $author = new Author();
        $author->setName("Mohamed");
        $author->setEmail("mohamed@gmail.com");
        $author->setAddress("Ariana");
        $author->setNbrBooks("7");

        // Persist the object in the doctrine
        $em = $doctrine->getManager();
        $em->persist($author);
        $em->flush();

        return $this->redirectToRoute("app_crud_author");
    }

    // Method to delete an author
    #[Route('/delete/{id}', name: 'app_crud_delete')]
    public function deleteAuthor(Author $author, ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $em->remove($author);
        $em->flush();
        
        return $this->redirectToRoute("app_crud_author");
    }

    // Method to update an author
    #[Route('/update/{id}', name: 'app_crud_update')]
    public function updateAuthor(Author $author, ManagerRegistry $doctrine): Response {
        $author->setName("Mehdi");
        $author->setEmail("mehdi@gmail.com");
        $author->setAddress("Tunis");
        $author->setNbrBooks("11");

        // Persist the object in the doctrine
        $em = $doctrine->getManager();
        $em->persist($author);
        $em->flush();

        return $this->redirectToRoute("app_crud_author");
    }

    // 2nd method to update an author
    // #[Route('/update/{id}', name: 'app_crud_update')]
    // public function updateAuthor(Request $request, AuthorRepository $rep, ManagerRegistry $doctrine): Response {
    //     // Get the old object from the data base
    //     $id = $request->get("id");
    //     $author = $rep->find($id);

    //     // Update the object
    //     $author->setName("Mustapha");
    //     $author->setEmail("Mustapha@gmail.com");
    //     $author->setAddress("Zaghouan");
    //     $author->setNbrBooks("5");

    //     // Dave update in the DB
    //     $em = $doctrine->getManager();
    //     $em->flush();

    //     return $this->redirectToRoute("app_crud_author");
    // }
}
