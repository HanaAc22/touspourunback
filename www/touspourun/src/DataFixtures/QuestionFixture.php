<?php

namespace App\DataFixtures;

use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $questions = QuestionFactory::createMany(10);

       QuestionFactory::new()
           ->many(5)
           ->create()
       ;

       AnswerFactory::createMany(60, function() use ($questions){
          return [
           'question' => $questions[array_rand($questions)]
           ];
       });
    }
}
