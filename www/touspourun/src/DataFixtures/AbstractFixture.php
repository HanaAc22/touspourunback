<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

abstract class AbstractFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dataFile = sprintf('%s/%s', $this->getDir(), $this->getFileNameToParse());

        if(!file_exists($dataFile)){
            return;
        }

        $data = Yaml::parseFile($dataFile, Yaml::PARSE_CONSTANT);

        foreach ($data as $key => $item){
            $entity = $this->buildEntity($item);
            $manager->persist($entity);

            if(is_string($key) && $reference = static::getReferenceName()){
                $referenceId = sprintf('%s/%s', $reference, $key);
                $this->addReference($referenceId, $entity);
            }
        }
        $manager->flush();
    }
    public function getDir(): string
    {
        return __DIR__.'/datas';
    }
    public function getFileNameToParse(): string
    {
        return sprintf('%s.yaml', static::getReferenceName());
    }
    /**
     * @params array<string, mixed> $data
     */
    abstract public function buildEntity(array $data): mixed;
    abstract public static function getReferenceName(): string;

}