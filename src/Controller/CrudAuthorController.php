<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
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
}
