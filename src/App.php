<?php

declare(strict_types=1);

namespace OpenFakeGenerator;

use OpenFakeGenerator\Controller\Api;
use OpenFakeGenerator\Controller\ControllerInterface;
use OpenFakeGenerator\Controller\Index;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class App
{
    public const CACHE_DIR = __DIR__.'/../cache';

    private Request $request;

    public function run(): Response
    {
        try {
            $this->request = Request::createFromGlobals();

            $controller = $this->dispatch();

            return $controller($this->request)->send();
        } catch (\Throwable $e) {
            $response = new Response(sprintf(
                'Message: %s
                Trace: %s',
                $e->getMessage(),
                $e->getTraceAsString()
            ), 500);

            return $response->send();
        }
    }

    public function dispatch(): ControllerInterface
    {
        $request_uri = \str_replace($this->request->getBasePath(), '', $this->request->getRequestUri());

        if (true === \str_starts_with($request_uri, '/api')) {
            return new Api();
        }

        return new Index();
    }
}
