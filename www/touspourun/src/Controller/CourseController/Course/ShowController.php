<?php

namespace App\Controller\CourseController\Course;

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

        return $this->render('courses/course_content/show.html.twig',[
            'courses' => $courses
        ]);
    }
}