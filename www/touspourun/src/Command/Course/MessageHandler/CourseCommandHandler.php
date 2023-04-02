<?php

namespace App\Command\Course\MessageHandler;

use App\Entity\Course;
use App\Form\Model\ContentFormModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CourseCommandHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ContentFormModel $courseModel
    ){

    }
    public function __invoke(Course $course): void
    {
        $course
            ->setTitle($this->courseModel->getTitle())
            ->setPicture($this->courseModel->getPicture())
            ->setContent($this->courseModel->getContent())
            ->setCreatedAt($this->courseModel->getCreatedAt())
            ->setUpdatedAt($this->courseModel->getUpdatedAt())
        ;

        $this->entityManager->persist($course);
        $this->entityManager->flush();
    }
}