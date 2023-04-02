<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\ContentType;
use App\Form\Model\ContentFormModel;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use  \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/course', name: 'course_')]
class ContentController extends AbstractController
{
    #[Route('/create', name: 'create')]
    public function create(TranslatorInterface $translator, Request $request, EntityManagerInterface $entityManager): Response
    {
        $course = new Course();

        $form = $this->createForm(ContentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $courseModel = $form->getData();

            $course
                ->setTitle($courseModel->getTitle())
                ->setPicture($courseModel->getPicture())
                ->setContent($courseModel->getContent())
                ->setCreatedAt($courseModel->getCreatedAt())
                ->setUpdatedAt($courseModel->getUpdatedAt())
            ;

            $entityManager->persist($course);
            $entityManager->flush();

            $successMessage = $translator->trans('course.create.success');
            return new Response($successMessage);
        }

            return $this->render('Content/createContent.html.twig', [
                'contentCreateForm' => $form->createView()
            ]);
    }

    #[Route('/update/{id}', name: '_update')]
    public  function edit($id, EntityManagerInterface $entityManager, Request $request, TranslatorInterface $translator): Response
    {
        $course = $entityManager->getRepository(Course::class)->find($id);

        $courseModel = new ContentFormModel($course);

        $form = $this->createForm(ContentType::class, $courseModel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $courseModel = $form->getData();

            $course
                ->setTitle($courseModel->getTitle())
                ->setPicture($courseModel->getPicture())
                ->setContent($courseModel->getContent())
                ->setCreatedAt($courseModel->getCreatedAt())
                ->setUpdatedAt($courseModel->getUpdatedAt())
            ;

            $entityManager->persist($course);
            $entityManager->flush();

            $successMessage = $translator->trans('course.update.success');
            return new Response($successMessage);

        }

        return $this->render('Content/updateContent.html.twig',[
            'updateContentForm' => $form->createView(),
        ]);
    }


}