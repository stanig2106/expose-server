<?php

namespace Expose\Server\Http\Controllers\Admin;

use Expose\Server\Configuration;
use Expose\Server\Connections\ControlConnection;
use Expose\Server\Contracts\ConnectionManager;
use Expose\Server\Contracts\UserRepository;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;

class GetSitesController extends AdminController
{
    protected $keepConnectionOpen = true;

    /** @var ConnectionManager */
    protected $connectionManager;

    /** @var Configuration */
    protected $configuration;

    /** @var UserRepository */
    protected $userRepository;

    public function __construct(ConnectionManager $connectionManager, Configuration $configuration, UserRepository $userRepository)
    {
        $this->connectionManager = $connectionManager;
        $this->userRepository = $userRepository;
    }

    public function handle(Request $request, ConnectionInterface $httpConnection)
    {
        $authTokens = [];

        $sites = collect($this->connectionManager->getConnections())
            ->filter(function ($connection) {
                return get_class($connection) === ControlConnection::class;
            })
            ->map(function ($site, $siteId) use (&$authTokens) {
                $site = $site->toArray();
                $site['id'] = $siteId;
                $authTokens[] = $site['auth_token'];

                return $site;
            })->values();

        $this->userRepository->getUsersByTokens($authTokens)
            ->then(function ($users) use ($httpConnection, $sites) {
                $users = collect($users);
                $sites = collect($sites)->map(function ($site) use ($users) {
                    $site['user'] = $users->firstWhere('auth_token', $site['auth_token']);

                    return $site;
                })->toArray();

                $httpConnection->send(
                    respond_json([
                        'sites' => $sites,
                    ])
                );

                $httpConnection->close();
            });
    }
}
