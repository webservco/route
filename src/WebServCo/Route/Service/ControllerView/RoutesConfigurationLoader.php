<?php

declare(strict_types=1);

namespace WebServCo\Route\Service\ControllerView;

use UnexpectedValueException;
use WebServCo\Configuration\Contract\ConfigurationLoaderInterface;

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

        foreach ($data as $key => $value) {
            if (!is_string($key)) {
                throw new UnexpectedValueException('Key is not a string.');
            }
            if (!is_string($value)) {
                throw new UnexpectedValueException('Key is not a string.');
            }
            $result[$key] = new RouteConfiguration($value);
        }

        return $result;
    }
}
