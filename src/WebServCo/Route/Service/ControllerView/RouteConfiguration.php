<?php

declare(strict_types=1);

namespace WebServCo\Route\Service\ControllerView;

use WebServCo\Route\Contract\RouteConfigurationInterface;

/**
 * A route configuration implementation using the controller/view system.
 */
final class RouteConfiguration implements RouteConfigurationInterface
{
    public function __construct(public readonly string $controllerClass)
    {
    }
}
