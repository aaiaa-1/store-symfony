<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddProductController extends AbstractController
{
    #[Route('/add', name: 'app_add_product')]
    public function add(Request $request, EntityManagerInterface $em , SluggerInterface $slugger): Response
    {
        //we create a new product
        $product =new Product();
        //we create our form
        $productForm =$this->createForm(ProductFormType::class, $product);
        //traiter la requête du Form
        $productForm->handleRequest($request);
        //on vérifie si le formulaire est soumis et valide 
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            //On génére le Slug
            $slug = $slugger->slug($product->getName());
            $product->setSlug($slug);

            //on stock les infos dans BD
            $em->persist($product);
            $em->flush();

            //message de succès
            $this->addFlash('success', 'You have successfully added a new product');

            //redirect the user back to the homepage
            return $this->redirectToRoute('app_add_product');
        }
 
        return $this->render('add_product/index.html.twig', compact('productForm'));
    } 
}
