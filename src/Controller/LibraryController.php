<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/library")]
class LibraryController extends AbstractController
{
    #[Route('/list', name: 'app_library_list')]
    public function list(LibraryRepository $repository): Response {
        
        $list = $repository->findAll();
        return $this->render("library/list.html.twig",
        ["list"=>$list]);
    }

    #[Route('/search/{name}', name: 'app_library_search')]
    public function searchByName(LibraryRepository $repository, Request $request) : Response {
        // Get the data name from the request
        $name = $request->get("name");
        $list = $repository->findByName($name);
        return $this->render("library/list.html.twig",
        ["list"=>$list]);
    }

    #[Route('/new', name: 'app_library_create')]
    public function newLibrary(ManagerRegistry $doctrine): Response {

        // Create an instance from the class author
        $library = new Library();
        $library->setName("Al_Fikr");
        $library->setWebsite("alfikr.library.tn");
        $creationDate = new \DateTime('2024-08-21');
        $library->setCreationDate($creationDate);

        // Persist the object in the doctrine
        $em = $doctrine->getManager();
        $em->persist($library);
        $em->flush();

        return $this->redirectToRoute("app_library_list");
    }

    // Method to delete a library
    #[Route('/delete/{id}', name: 'app_library_delete')]
    public function deleteAuthor(Library $library, ManagerRegistry $doctrine): Response {
        $em = $doctrine->getManager();
        $em->remove($library);
        $em->flush();
        
        return $this->redirectToRoute("app_library_list");
    }

    // Method to update an author
    #[Route('/update/{id}', name: 'app_library_update')]
    public function updateAuthor(Library $library, ManagerRegistry $doctrine): Response {
        $library->setName("Farid");
        $library->setWebsite("farid.library.tn");
        $creationDate = new \DateTime('2024-09-29');
        $library->setCreationDate($creationDate);

        // Persist the object in the doctrine
        $em = $doctrine->getManager();
        $em->persist($library);
        $em->flush();

        return $this->redirectToRoute("app_library_list");
    }
}
