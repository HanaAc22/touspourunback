<?php

namespace App\Controller\Forum;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\Forum\AnswerType;
use App\Form\Forum\QuestionType;
use App\Form\Model\QuestionFormModel;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/forum', name:'forum_')]
class QuestionController extends AbstractController
{
    public function __construct(
        private readOnly EntityManagerInterface $entityManager
    ){
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

        return $this->render('forum/create-question.html.twig', [
            'questionCreateForm' => $form->createView(),
            'question' => $question
        ]);
    }

    #[Route('/questions/show', name: 'questions_show')]
    public function showAll(
        QuestionRepository $questionRepository,
    ): Response
    {
        $questions = $questionRepository->findQuestionsWithAnswers();

        return $this->render('forum/show-all.html.twig', [

            'questions' => $questions,
        ]);
    }

    #[Route('/question/show/{id}', name: 'question_show')]
    public function show(
        EntityManagerInterface $entityManager,
        Request $request,
        int $id
    ): Response
    {
        $question = $entityManager->getRepository(Question::class)->find($id);

        $answer = new Answer();

        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $question = $entityManager->getRepository(Question::class)->find($id);

            $answer
                ->setUsername($answer->getUsername())
                ->setContent($answer->getContent())
                ->setQuestion($question)
            ;
            $entityManager->persist($answer);
            $entityManager->flush();
        }

        return $this->render('forum/show.html.twig', [
            'question' => $question,
            'answerForm' => $form->createView()
        ]);
    }
}
