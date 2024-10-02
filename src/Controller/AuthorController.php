<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/author")]
class AuthorController extends AbstractController
{
    #[Route("/show", name:"app_author_show")]
    public function showAuthor(): Response {
        $authorName = "Victor Hugo";
        $authorEmail = "vh@gmail.com";
        return $this->render("author/showAuthor.html.twig",
        array(
            "authorName"=>$authorName,
            "authorEmail"=>$authorEmail
        ));
    }

    #[Route("/list", name:"app_author_list")]
    public function listAuthors(): Response {
        $authors = [
            ["authorName"=>"Victor Hugo", "authorImage"=>"images/Photo.jpg", "numberOfBooks"=>44],
            ["authorName"=>"William Shakespeare", "authorImage"=>"images/Photo.jpg", "numberOfBooks"=>55],
            ["authorName"=>"Taha Hsin", "authorImage"=>"images/Photo.jpg", "numberOfBooks"=>33]
        ];

        return $this->render("author/listAuthors.html.twig",
            array(
                "authors"=>$authors
            )
        );
    }

}