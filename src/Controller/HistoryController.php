<?php

namespace App\Controller;

use App\Repository\HistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class HistoryController extends AbstractController
{
    public function __construct(
        private readonly HistoryRepository $historyRepository,
    ){}

    public function __invoke(): JsonResponse
    {
        $history = $this->historyRepository->findBy(['type' => 'secondType']);

        if (!$history) {
            throw $this->createNotFoundException('History not found');
        }

        return $this->json($history, 200, [], ['groups' => ['history:read']]);
    }
}
