<?php

declare(strict_types=1);

namespace WebServCo\Route\Service\ControllerView;

use OutOfBoundsException;
use UnexpectedValueException;
use WebServCo\Configuration\Contract\ConfigurationLoaderInterface;

use function array_key_exists;
use function is_array;
use function is_string;

final class RoutesConfigurationLoader
{
    public function __construct(private ConfigurationLoaderInterface $configurationLoader)
    {
    }

    /**
     * @return array<string,\WebServCo\Route\Service\ControllerView\RouteConfiguration>
     */
    public function loadFromFile(string $filePath): array
    {
        $data = $this->configurationLoader->loadFromFile($filePath);

        $result = [];

        /**
          * Psalm error: "Unable to determine the type that $.. is being assigned to"
          * However this is indeed mixed, no solution but to supress error.
          *
          * @psalm-suppress MixedAssignment
          */
        foreach ($data as $key => $value) {
            if (!is_string($key)) {
                throw new UnexpectedValueException('Key is not a string.');
            }
            $result[$key] = $this->processRouteConfiguration($value);
        }

        return $result;
    }

    private function processRouteConfiguration(mixed $data): RouteConfiguration
    {
        if (!is_array($data)) {
            throw new UnexpectedValueException('Value is not an array');
        }
        if (!array_key_exists(0, $data)) {
            throw new OutOfBoundsException('Key does not exist in array.');
        }
        if (!is_string($data[0])) {
            throw new UnexpectedValueException('Value is not a string.');
        }
        if (!array_key_exists(1, $data)) {
            throw new OutOfBoundsException('Key does not exist in array.');
        }
        if (!is_string($data[1])) {
            throw new UnexpectedValueException('Value is not a string.');
        }

        return new RouteConfiguration($data[0], $data[1]);
    }
}
