<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\ContentType;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use  \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/course', name: 'course')]
class ContentController extends AbstractController
{
    #[Route('/create', name: 'create')]
    public function create(TranslatorInterface $translator, Request $request, EntityManagerInterface $entityManager): Response
    {
        $course = new Course();

        $form = $this->createForm(ContentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $courseModel = $form->getData();

            $course
                ->setTitle($courseModel->title)
                ->setPicture($courseModel->picture)
                ->setContent($courseModel->content)
                ->setCreatedAt($courseModel->createdAt)
                ->setUpdatedAt($courseModel->updatedAt)
            ;

            $entityManager->persist($course);
            $entityManager->flush();

            $successMessage = $translator->trans('course.create.success');
            return new Response($successMessage);
        }

            return $this->render('Content/createForm.html.twig', [
                'contentCreateForm' => $form->createView()
            ]);


    }


}