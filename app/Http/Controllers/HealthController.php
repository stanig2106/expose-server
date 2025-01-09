<?php

namespace Expose\Server\Http\Controllers;

use Expose\Common\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;

class HealthController extends Controller
{

    public function handle(Request $request, ConnectionInterface $httpConnection)
    {
        $httpConnection->send(
            respond_html("OK", 200)
        );
    }

}
