<?php

namespace Expose\Server\Http\Controllers\Admin;

use Expose\Server\Configuration;
use Expose\Server\Contracts\ConnectionManager;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;

class ShowSettingsController extends AdminController
{
    /** @var ConnectionManager */
    protected $connectionManager;

    /** @var Configuration */
    protected $configuration;

    public function __construct(ConnectionManager $connectionManager, Configuration $configuration)
    {
        $this->connectionManager = $connectionManager;
        $this->configuration = $configuration;
    }

    public function handle(Request $request, ConnectionInterface $httpConnection)
    {
        $httpConnection->send(
            respond_html($this->getView($httpConnection, 'server.settings.index', [
                'configuration' => $this->configuration,
            ]))
        );
    }
}
