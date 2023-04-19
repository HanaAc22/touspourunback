<?php

namespace App\Controller\CourseController\CourseCategory;

use App\Entity\Courses\Category;
use App\Form\Course\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/course/category', name: 'course_category_')]
class CourseCategoryController extends AbstractController
{
    #[Route('/create', name: 'create')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categories = new Category();

        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $categories->setName($form->get('name')->getData());

            $entityManager->persist($categories);
            $entityManager->flush();

            $this->redirectToRoute('course_show');
        }

        return $this->render('courses/course_category/index.html.twig', [
            'categoriesForm' => $form->createView(),
        ]);
    }
}
