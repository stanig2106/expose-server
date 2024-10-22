<?php

namespace Expose\Server\Contracts;

use React\Promise\PromiseInterface;

interface LoggerRepository
{
    public function logSubdomain($authToken, $subdomain);

    public function getLogs(): PromiseInterface;

    public function getLogsBySubdomain($subdomain): PromiseInterface;
}
