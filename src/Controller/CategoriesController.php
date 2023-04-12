<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category_productList')]
    public function list(Category $category): Response
    { 
        //search the list of the products of the category
        $products =$category->getProducts(); 
        
        return $this->render('category/list.html.twig', 
                      compact('category','products')
            );
    }
}
