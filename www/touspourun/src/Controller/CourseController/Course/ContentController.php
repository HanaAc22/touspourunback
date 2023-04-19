<?php

namespace App\Controller\CourseController\Course;

use App\Command\Course\Message\CourseCommand;
use App\Controller\CourseController\CourseTrait\PictureExtentionTrait;
use App\Entity\Course;
use App\Form\Course\ContentType;
use App\Form\Model\ContentFormModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/course', name: 'course_')]
class ContentController extends AbstractController
{
    use PictureExtentionTrait;
    #[Route('/create', name: 'create')]
    public function create(SluggerInterface $slugger, Request $request, MessageBusInterface $messageBus): Response
    {
        $form = $this->createForm(ContentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $course = new Course();

            $courseModel = new ContentFormModel();

            $courseModel = $form->getData();
            $imageFile = $form->get('picture')->getData();

            if ($imageFile) {
                $newFilename = $this->uploadFile($imageFile, $slugger);
                $course->setPicture($newFilename);
            }

            $messageBus->dispatch(new CourseCommand($course, $courseModel));

            return new Response('course created with success');
        }
            return $this->render('courses/course_content/createContent.html.twig', [
                'contentCreateForm' => $form->createView()
            ]);
    }

    #[Route('/update/{id}', name: '_update')]
    public  function edit($id, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger ,MessageBusInterface $messageBus): Response
    {
        $course = $entityManager->getRepository(Course::class)->find($id);

        $courseModel = new ContentFormModel($course);

        $form = $this->createForm(ContentType::class, $courseModel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $form->getData();

            $imageFile = $form->get('picture')->getData();

            if ($imageFile) {
                $newFilename = $this->uploadFile($imageFile, $slugger);
                $course->setPicture($newFilename);
            }

            $messageBus->dispatch(new CourseCommand($course, $courseModel));

            return new Response('course created with success');
        }

        return $this->render('courses/course_content/updateContent.html.twig',[
            'updateContentForm' => $form->createView(),
        ]);
    }

}
