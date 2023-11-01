<?php

namespace App\DataFixtures;

use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use App\Factory\QuestionTagFactory;
use App\Factory\TagFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email' => 'abraca_admin@example.com',
            'roles' => ['ROLE_ADMIN'],
            'avatar' => 'default.png'
        ]);

        UserFactory::createOne([
            'email' => 'abraca_user@example.com',
        ]);
        UserFactory::createMany(5);

        TagFactory::createMany(8);

        $questions = QuestionFactory::new()->createMany(9, fn() => [
            'owner' => UserFactory::random(),
        ]);

        QuestionTagFactory::new()->createMany(10, fn() => [
            'question' => QuestionFactory::random(),
            'tag' => TagFactory::random(),
        ]);

        QuestionFactory::new()->unpublished()->createMany(5);

        AnswerFactory::new()
            ->createMany(10, fn() => [
                'question' => $questions[array_rand($questions)],
            ]);

        AnswerFactory::new()->needsApproval()->many(5)->create();

        $manager->flush();
    }
}
