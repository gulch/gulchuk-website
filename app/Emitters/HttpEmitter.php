<?php

namespace App\Emitters;

use App\Contracts\Emitter;
use Psr\Http\Message\ResponseInterface;
use function header, sprintf;

class HttpEmitter implements Emitter
{
    /**
     * @var array $emptyResponseCodes
     */
    private $emptyResponseCodes = [204, 205, 304];

    /**
     * @var int $sizeLimit
     */
    private $sizeLimit = 4096;

    /**
     * Emits headers, protocol, status code and reason
     * phrase from response.
     *
     * @param ResponseInterface $response
     * @return void
     */
    private function headers(ResponseInterface $response): void
    {
        if (false === \headers_sent()) {

            foreach ($response->getHeaders() as $name => $values) {
                $name = \str_replace('_', '-', $name);
                $name = \ucwords(\strtolower($name), '-');
                $isNotCookieHeader = $name !== 'Set-Cookie';
                foreach ($values as $value) {
                    header(sprintf('%s: %s', $name, $value), $isNotCookieHeader);
                    $isNotCookieHeader = false;
                }
            }

            header(
                sprintf(
                    'HTTP/%s %s %s',
                    $response->getProtocolVersion(),
                    $response->getStatusCode(),
                    $response->getReasonPhrase()
                ),
                true, 
                $response->getStatusCode()
            );
        }
    }

    /**
     * Writes body.
     *
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    private function body(ResponseInterface $response): ResponseInterface
    {
        // if response not empty echo content
        if (false === \in_array($response->getStatusCode(), $this->emptyResponseCodes)) {

            $stream = $response->getBody();
            
            if ($stream->isSeekable()) {
                $stream->rewind();
            }

            $contentLength = $response->getHeaderLine('Content-Length') ?: $stream->getSize();
            
            if ($contentLength > 0) {
                $lengthToRead = $contentLength;
                while ($lengthToRead > 0 && !$stream->eof()) {
                    $data = $stream->read(
                        \min($this->sizeLimit, $lengthToRead)
                    );
                    echo $data;
                    $lengthToRead -= \strlen($data);
                }
            } else {
                while (!$stream->eof()) {
                    echo $stream->read($this->sizeLimit);
                }
            }
        }

        return $response;
    }

    /**
     * Emits response.
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    public function emit(ResponseInterface $response)
    {
        $this->headers($response);
        $this->body($response);
    }
}
