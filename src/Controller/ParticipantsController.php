<?php

namespace App\Controller;

use App\Repository\ParticipantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ParticipantsController extends AbstractController
{
    public function __construct(
        private readonly ParticipantsRepository $participantsRepository,
    ){}

    public function __invoke(): JsonResponse
    {
        $participants = $this->participantsRepository->findBy(['type' => 'firstType']);

        if (!$participants) {
            throw $this->createNotFoundException('Participant not found');
        }

        return $this->json($participants, 200, [], ['groups' => ['participants:read']]);
    }
}
