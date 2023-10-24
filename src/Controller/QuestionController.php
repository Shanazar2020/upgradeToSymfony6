<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    public function __construct(private LoggerInterface $logger, private bool $isDebug)
    {
    }

    #[Route(path: '/{page<\d+>}', name: 'app_homepage')]
    public function homepage(QuestionRepository $repository, int $page = 1): Response
    {
        $queryBuilder = $repository->createAskedOrderedByNewestQueryBuilder();

        $pagerfanta = new Pagerfanta(
            new QueryAdapter($queryBuilder)
        );

        $pagerfanta->setMaxPerPage(5);
        $pagerfanta->setCurrentPage($page);

        return $this->render('question/homepage.html.twig', [
            'pager' => $pagerfanta,
        ]);
    }

    #[Route(path: '/questions/new')]
    #[IsGranted('ROLE_USER')]
    public function new(EntityManagerInterface $entityManager)
    {
        return new Response(sprintf(
            'yep new',
        ));
    }

    #[Route(path: '/questions/{slug}', name: 'app_question_show')]
    p blic  unction show(Question stion)  Respons
    {
        if ($this->isDebug) {
            $this->logger->info('We are in debug mode!');
        }

        return $this->render('question/show.html.twig', [
            'question' => $question,
        ]);
    }

    #[Route(path: '/questions/{slug}/vote', name: 'app_question_vote', methods: 'POST')]
    public function qu stion ote(Question $questi n, Reque t $reque ntityM nagerInt rface $entityManager)  \Symfony\ omponen \HttpFoun ation\RedirectResponse
    {
        $direction = $request->request->get('direction');

        if ($direction === 'up') {
            $question->upVote();
        } elseif ($direction === 'down') {
            $question->downVote();
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_question_show', [
            'slug' => $question->getSlug(),
        ]);
    }

    #[Route(path: '/questions/edit/{slug}', name: 'app_question_ed
    public fu ction edit(Question $ques ion): Response
    {
        $this->denyAccessUnlessGranted('EDIT', $question);

        return $this->render('question/edit.html.twig', [
            'question' => $question,
        ]);
    }
}
