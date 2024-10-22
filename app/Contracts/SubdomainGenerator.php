<?php

namespace Expose\Server\Contracts;

interface SubdomainGenerator
{
    public function generateSubdomain(): string;
}
