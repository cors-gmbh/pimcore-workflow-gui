<?php
/**
 * CORS GmbH.
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) CORS GmbH (https://www.cors.gmbh)
 * @license    https://www.cors.gmbh/license     GPLv3 and PCL
 */

declare(strict_types=1);

namespace CORS\Bundle\WorkflowGUI\Repository;

use Pimcore\Bundle\CoreBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;
use CORS\Bundle\WorkflowGUI\Resolver\ConfigFileResolverInterface;

class WorkflowRepository implements WorkflowRepositoryInterface
{
    protected ConfigFileResolverInterface $configFileResolver;

    public function __construct(ConfigFileResolverInterface $configFileResolver)
    {
        $this->configFileResolver = $configFileResolver;
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
            ARRAY_FILTER_USE_KEY
        );

        return reset($filtered);
    }

    public function updateConfig(callable $workflowsRewriter): void
    {
        $config = $this->loadConfig();
        $config['pimcore']['workflows'] = $workflowsRewriter($config['pimcore']['workflows'] ?: []);
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
            file_get_contents($this->configFileResolver->getConfigPath())
        );
    }

    protected function storeConfig(array $config): void
    {
        file_put_contents(
            $this->configFileResolver->getConfigPath(),
            Yaml::dump($config, 100)
        );
    }
}
