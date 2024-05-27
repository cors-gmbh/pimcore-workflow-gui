<?php

declare(strict_types=1);

/*
 * CORS GmbH
 *
 * This software is available under the GNU General Public License version 3 (GPLv3).
 *
 * @copyright  Copyright (c) CORS GmbH (https://www.cors.gmbh)
 * @license    https://www.cors.gmbh/license GPLv3
 */

namespace CORS\Pimcore\WorkflowGUI\Repository;

use Pimcore\Bundle\CoreBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;
use CORS\Pimcore\WorkflowGUI\Resolver\ConfigFileResolverInterface;

class WorkflowRepository implements WorkflowRepositoryInterface
{
    public function __construct(
        protected ConfigFileResolverInterface $configFileResolver,
    ) {
    }

    public function findAll(): array
    {
        return $this->processConfiguration();
    }

    public function find($id): array
    {
        $all = $this->findAll();
        $filtered = array_filter(
            $all,
            function ($key) use ($id) {
                return $id === $key;
            },
            \ARRAY_FILTER_USE_KEY,
        );

        return reset($filtered);
    }

    public function updateConfig(callable $workflowsRewriter): void
    {
        $config = $this->loadConfig();
        $config['pimcore']['workflows'] = $workflowsRewriter($config['pimcore']['workflows']);
        $this->storeConfig($config);
    }

    protected function processConfiguration(): array
    {
        $config = $this->loadConfig();

        $configuration = new Configuration();
        $processor = new Processor();

        $config = $processor->processConfiguration($configuration, $config ?? []);

        return $config['workflows'];
    }

    protected function loadConfig(): array
    {
        return Yaml::parse(
            file_get_contents($this->configFileResolver->getConfigPath()),
        ) ?? [];
    }

    protected function storeConfig(array $config): void
    {
        file_put_contents(
            $this->configFileResolver->getConfigPath(),
            Yaml::dump($config, 100),
        );
    }
}
