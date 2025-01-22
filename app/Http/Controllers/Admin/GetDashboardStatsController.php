<?php

namespace Expose\Server\Http\Controllers\Admin;

use Expose\Server\Contracts\ConnectionManager;
use Expose\Server\Contracts\StatisticsRepository;
use Expose\Server\Contracts\UserRepository;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;
use function React\Promise\all;

class GetDashboardStatsController extends AdminController
{
    protected $keepConnectionOpen = true;

    protected UserRepository $userRepository;

    protected ConnectionManager $connectionManager;

    protected StatisticsRepository $statisticsRepository;

    public function __construct(ConnectionManager $connectionManager, UserRepository $userRepository, StatisticsRepository $statisticsRepository)
    {
        $this->connectionManager = $connectionManager;
        $this->userRepository = $userRepository;
        $this->statisticsRepository = $statisticsRepository;
    }

    public function handle(Request $request, ConnectionInterface $httpConnection)
    {

        all([
            'userCount' => $this->userRepository->userCount(),
            'siteCount' => \React\Promise\resolve(count($this->connectionManager->getConnections())),
            'statistics' => $this->statisticsRepository->getStatistics(today()->subWeek()->toDateString(), today()->toDateString()),
        ])->then(function ($results) use ($httpConnection) {
            $httpConnection->send(
                respond_json($results)
            );

            $httpConnection->close();
        });
    }
}
