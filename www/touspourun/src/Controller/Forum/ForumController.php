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
class ForumController extends AbstractController
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

    #[Route('/question/update/{id}', name: 'question_update')]
    public function update(
        int $id,
        Request $request,
    ): Response
    {
        $question = $this->entityManager->getRepository(Question::class)->find($id);
        $questionModel = new QuestionFormModel($question);

        $form = $this->createForm(QuestionType::class, $questionModel);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $questionModel = $form->getData();

            $question
                ->setName($questionModel->getName())
                ->setQuestion($questionModel->getQuestion())
                ->setSlug($questionModel->getQuestion())
            ;

            $this->entityManager->persist($question);
            $this->entityManager->flush();
        }

        return $this->render('forum/update-question.html.twig', [
            'updateQuestionForm' => $form->createView()
        ]);
    }

    #[Route('/question/delete/{id}', name:'delete_question')]
    public function delete(
        int $id
    ): Response
    {
        $question = $this->entityManager->getRepository(Question::class)->find($id);

        $question->setIsDeleted(true);

        $this->entityManager->persist($question);
        $this->entityManager->flush();

        return $this->redirectToRoute('forum_questions_show');
    }
}
