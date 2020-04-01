<?php declare(strict_types=1);

namespace Models;

use Bref\Event\InvalidLambdaEvent;
use Bref\Event\LambdaEvent;

/**
 * Represents a Lambda event that comes from a HTTP request.
 *
 * The event can come from API Gateway or ALB (Application Load Balancer).
 */
final class CustomLambdaEvent implements LambdaEvent
{
    /** @var array */
    private $event;

    public function __construct(array $event)
    {
        // if (! is_array($event) || ! isset($event['httpMethod'])) {
        //     throw new InvalidLambdaEvent('API Gateway or ALB', $event);
        // }

        $this->event = $event;
        // $this->method = strtoupper($this->event['httpMethod']);
        // $this->queryString = $this->rebuildQueryString();
        // $this->headers = $this->extractHeaders();
    }

    public function toArray(): array
    {
        return $this->event;
    }
}