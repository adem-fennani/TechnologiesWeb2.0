<?php

namespace App\Controller;

use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
