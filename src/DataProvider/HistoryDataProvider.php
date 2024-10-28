<?php

namespace App\DataProvider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\History;
use App\Repository\HistoryRepository;

readonly class HistoryDataProvider implements ProviderInterface
{
    public function __construct(
        private HistoryRepository $historyRepository,
    )
    {
    }

    public function supports(string $resourceClass): bool
    {
        return History::class === $resourceClass;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        return array_values($this->historyRepository->findBy(['type' => 'secondType']));
    }
}