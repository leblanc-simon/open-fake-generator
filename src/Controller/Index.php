<?php

declare(strict_types=1);

namespace OpenFakeGenerator\Controller;

use OpenFakeGenerator\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Index extends AbstractController implements ControllerInterface
{
    public function __invoke(Request $request): Response
    {
        $preferred_language = $request->get('locale', $request->getPreferredLanguage());
        $datas = $this->getDatas($request);

        $template = new Template($preferred_language);

        $template_name = \strtolower(\str_replace('OpenFakeGenerator\\Model\\', '', \get_class($datas)));

        return new Response($template->render($template_name.'.html.twig', [
            $template_name => $datas,
        ]));
    }
}
