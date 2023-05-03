<?php

namespace App\DataFixtures;

use App\Entity\Course;
use DateTimeImmutable;
use Exception;

class CourseFixture extends AbstractFixture
{
    /**
     * @throws Exception
     */
    public function buildEntity(array $data): Course
    {
        $course = new Course();

        $course
            ->setTitle($data['title'])
            ->setContent($data['content'])
            ->setCreatedAt(new DateTimeImmutable($data['createdAt']))
            ->setPicture($data['picture'])
            ->setIsDeleted($data['isDeleted'])
        ;

        $this->setReference(self::getReferenceName(), $course);

        return $course;
    }

    public static function getReferenceName(): string
    {
        return 'course';
    }
}