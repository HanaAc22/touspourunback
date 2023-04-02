<?php

namespace App\Controller\Course;

use App\Entity\Course;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/course', name: 'course_')]
class ShowController extends AbstractController
{
    #[Route('/show', name: 'show')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $courses = $entityManager->getRepository(Course::class)->findAll();

        return $this->render('Content/show.html.twig',[
            'courses' => $courses
        ]);
    }
}