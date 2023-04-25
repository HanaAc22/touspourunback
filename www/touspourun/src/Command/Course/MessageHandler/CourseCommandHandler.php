<?php

namespace App\Command\Course\MessageHandler;

use App\Command\Course\Message\CourseCommand;
use App\Entity\Category;
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
        $category = $command->getCategories();
        $course = $command->getCategories();
        $courseModel = $command->getCourseModel();
        $categories = $this->entityManager->getRepository(Category::class)->findAll();

        $course
            ->setTitle($courseModel->getTitle())
            ->setContent($courseModel->getContent())
            ->setCreatedAt($courseModel->getCreatedAt())
            ->setUpdatedAt($courseModel->getUpdatedAt())
            ->getCategories()
        ;
        foreach ($categories as $CategoryName){
            $CategoryName->setName($CategoryName->getName());
        }

        $this->entityManager->persist($course);
        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }
}
