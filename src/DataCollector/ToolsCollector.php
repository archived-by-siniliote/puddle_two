<?php

namespace App\DataCollector;

use Symfony\Bundle\FrameworkBundle\DataCollector\AbstractDataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ToolsCollector extends AbstractDataCollector
{
    public static function getTemplate(): ?string
    {
        return 'data_collector/template.html.twig';
    }

    public function collect(Request $request, Response $response, \Throwable $exception = null)
    {
    }
}
