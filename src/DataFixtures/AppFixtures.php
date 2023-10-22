<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\QuestionTag;
use App\Entity\Tag;
use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use App\Factory\QuestionTagFactory;
use App\Factory\TagFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        UserFactory::createOne([
            'email' => 'abraca_admin@example.com',
            'roles' => ['ROLE_ADMIN']
        ]);

        UserFactory::createOne([
            'email' => 'abraca_user@example.com'
        ]);
        UserFactory::createMany(10);


        TagFactory::createMany(100);

        $questions = QuestionFactory::new()->createMany(20, function () {
            return [
                'owner' => UserFactory::random(),
            ];
        });

        QuestionTagFactory::new()->createMany(100, function () {
            return [
                'question' => QuestionFactory::random(),
                'tag' => TagFactory::random(),
            ];
        });

        QuestionFactory::new()->unpublished()->createMany(5);

        AnswerFactory::new()
            ->createMany(100, function () use ($questions) {
                return [
                    'question' => $questions[array_rand($questions)]
                ];
            });

        AnswerFactory::new()->needsApproval()->many(20)->create();

        $manager->flush();
    }
}
