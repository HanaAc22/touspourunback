<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $answer = new Answer();
        $answer->setContent('This question is the best? I wish... I knew the answer.');
        $answer->setUsername('weaverryan');

        $question = new Question();
        $question->setName('How to un-disappear your wallet.');
        $question->setQuestion('... I should not have done this...');
        $question->setCreatedAt(new \DateTimeImmutable('now'));
        $answer->setQuestion($question);

        $manager->persist($answer);
        $manager->persist($question);
        $manager->flush();

    }
}