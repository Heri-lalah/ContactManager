<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'categories')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories ,
        ]);
    }

    #[Route('/categorie/{id}', name: 'showcategory')]
    public function show(CategoryRepository $categoryRepository, $id): Response
    {
        $category = $categoryRepository->find($id);

        return $this->render('category/fichecategory.html.twig', [
            'category' => $category ,
        ]);
    }
}
