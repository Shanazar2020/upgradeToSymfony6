#!/bin/bash

# List of conflicting files
files=(
".DS_Store"
".env"
".gitignore"
".idea/cauldron_overflow.iml"
".idea/codeception.xml"
".idea/php.xml"
".idea/phpspec.xml"
".idea/phpunit.xml"
"LICENSE"
"bin/console"
"composer.json"
"composer.lock"
"config/bundles.php"
"config/packages/cache.yaml"
"config/packages/framework.yaml"
"config/packages/monolog.yaml"
"config/packages/routing.yaml"
"config/packages/twig.yaml"
"config/services.yaml"
"public/index.php"
"README.md"
"assets/js/app.js"
"public/build/app.css"
"public/build/app.js"
"src/Controller/QuestionController.php"
"src/DataFixtures/AppFixtures.php"
"src/Entity/Question.php"
"src/Factory/QuestionFactory.php"
"symfony.lock"
"templates/base.html.twig"
"templates/question/homepage.html.twig"
"templates/question/show.html.twig"
"src/Entity/Answer.php"
"src/Repository/AnswerRepository.php"
"src/Factory/AnswerFactory.php"
"src/Controller/AnswerController.php"
"templates/answer/_answer.html.twig"
"templates/answer/popularAnswers.html.twig"
)

# Loop through the list of files and run the commands
for file in "${files[@]}"; do
  git checkout --theirs "$file"
  git add "$file"
git add .
done
