<?php

namespace Expose\Server\Contracts;

use Expose\Server\Connections\HttpConnection;
use Illuminate\Http\Request;

interface RequestModifier
{
    public function handle(Request $request, HttpConnection $httpConnection): ?Request;
}
