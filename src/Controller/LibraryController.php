<?php

namespace App\Controller;

use App\Repository\LibraryRepository;
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

    #[Route('/search/{name}', name: 'app_crud_search')]
    public function searchByName(LibraryRepository $repository, Request $request) : Response {
        // Get the data name from the request
        $name = $request->get("name");
        $list = $repository->findByName($name);
        return $this->render("library/list.html.twig",
        ["list"=>$list]);
    }
}
