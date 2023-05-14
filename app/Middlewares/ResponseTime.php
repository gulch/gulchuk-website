<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function microtime, sprintf;

class ResponseTime implements MiddlewareInterface
{
    private array $metrics = [];

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        
        $server = $request->getServerParams();

        $bootstrap_mark = microtime(true);

        // preload
        $duration = (\APP_START_TIME_FLOAT - $server['REQUEST_TIME_FLOAT']) * 1000;
        $this->addMetric('01_preload', sprintf('%2.2f', $duration));

        // composer autoload
        $duration = (\APP_AUTOLOADED_TIME_FLOAT - \APP_START_TIME_FLOAT) * 1000;
        $this->addMetric('02_autoload', sprintf('%2.2f', $duration));

        // bootstrap
        $duration = ($bootstrap_mark - \APP_AUTOLOADED_TIME_FLOAT) * 1000;
        $this->addMetric('03_bootstrap', sprintf('%2.2f', $duration));
       
        /** @var ResponseInterface $response */
        $response = $handler->handle($request);

        // application (my code)
        $duration = (microtime(true) - $bootstrap_mark) * 1000;
        $this->addMetric('04_app', sprintf('%2.2f', $duration));

        // total
        $duration = (microtime(true) - $server['REQUEST_TIME_FLOAT']) * 1000;
        $this->addMetric('total', sprintf('%2.2f', $duration));

        return $response->withHeader(
            'Server-Timing',
            $this->generateHeaderValue(),
        );
    }


    private function addMetric(string $name, string $value): void
    {
        $this->metrics[$name] = $value;
    }

    private function generateHeaderValue(): string
    {
        $result = '';

        foreach ($this->metrics as $key => $value) {
            if ($result !== '') {
                $result .= ',';
            }
            $result .= "{$key};dur={$value}";
        }

        return $result;
    }
}
