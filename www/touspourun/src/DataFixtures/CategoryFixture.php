<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Course;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function buildEntity(array $data): Category
    {
        $category = new Category();

        /** @var Course $course */
        $course = $this->getReference(CourseFixture::getReferenceName());

        $category
            ->setName($data['name'])
            ->getCourses()
        ;

        return $category;
    }

    public static function getReferenceName(): string
    {
        return 'categories';
    }

    public function getDependencies(): array
    {
        return [
            CourseFixture::class
        ];
    }
}