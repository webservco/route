<?php

declare(strict_types=1);

namespace WebServCo\Route\Contract\ThreePart;

/**
 * Names of route parts, using the three part system.
 */
interface RoutePartsInterface
{
    // WSFW: 'class'. Ideas: 'route', 'resource'.
    public const ROUTE_PART_1 = 'route.1';

    // WSFW: 'method'. Ideas: 'action'.
    public const ROUTE_PART_2 = 'route.2';

    // WSFW: 'arguments'.
    public const ROUTE_PART_3 = 'route.3';
}
