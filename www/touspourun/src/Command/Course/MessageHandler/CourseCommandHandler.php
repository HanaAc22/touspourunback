<?php

namespace App\Command\Course\MessageHandler;

use App\Command\Course\Message\CourseCommand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CourseCommandHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function __invoke(CourseCommand $command): void
    {
        $course = $command->getCourse();
        $courseModel = $command->getCourseModel();

        $course
            ->setTitle($courseModel->getTitle())
            ->setContent($courseModel->getContent())
            ->setCreatedAt($courseModel->getCreatedAt())
            ->setUpdatedAt($courseModel->getUpdatedAt())
        ;

        $this->entityManager->persist($course);
        $this->entityManager->flush();
    }
}
