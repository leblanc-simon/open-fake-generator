<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Api extends AbstractController implements ControllerInterface
{
    public function __invoke(Request $request): Response
    {
        $datas = $this->getDatas($request);

        return new JsonResponse($datas);
    }
}
