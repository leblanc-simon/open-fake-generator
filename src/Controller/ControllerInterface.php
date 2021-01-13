<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ControllerInterface
{
    public function __invoke(Request $request): Response;
}
