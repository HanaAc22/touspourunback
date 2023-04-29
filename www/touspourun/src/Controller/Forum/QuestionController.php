<?php

namespace App\Controller\Forum;

use App\Entity\Question;
use App\Form\Forum\QuestionType;
use App\Form\Model\QuestionFormModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/forum', name:'forum_')]
class QuestionController extends AbstractController
{
    public function __construct(private readOnly EntityManagerInterface $entityManager){
    }

    #[Route('/question/create', name: 'create_question')]
    public function questions(
        Request $request,
    ): Response
    {
        $question = new Question();
        $questionModel = new QuestionFormModel($question);

        $form = $this->createForm(QuestionType::class, $questionModel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $form->getData();

            $question
                ->setName($questionModel->getName())
                ->setSlug($questionModel->getName())
                ->setCreatedAt($questionModel->getCreatedAt())
                ->setQuestion($questionModel->getQuestion());

            $this->entityManager->persist($question);
            $this->entityManager->flush();
        }

        return $this->render('question/index.html.twig', [
            'questionCreateForm' => $form->createView(),
        ]);
    }
}
