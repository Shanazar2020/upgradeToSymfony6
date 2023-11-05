<?php

namespace App\DataFixtures;

use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
//use App\Factory\QuestionTagFactory;
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
            'avatar' => 'default.png',
            'isVerified' => true,
        ]);

        UserFactory::createOne([
            'email' => 'abraca_user@example.com',
            'isVerified' => true,
        ]);

        TagFactory::createMany(8);

        $questions = QuestionFactory::new()->createMany(9, fn() => [
            'owner' => UserFactory::random(),
            'tags' => TagFactory::randomRange(1, 5)
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
