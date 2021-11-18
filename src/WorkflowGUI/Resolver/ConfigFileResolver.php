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

namespace CORS\Bundle\WorkflowGUI\Resolver;

use Symfony\Component\Filesystem\Filesystem;

class ConfigFileResolver implements ConfigFileResolverInterface
{
    protected string $configFile;

    public function __construct(string $configFile)
    {
        $this->configFile = $configFile;
    }

    public function getConfigPath(): string
    {
        $fs = new Filesystem();

        if (!$fs->exists(dirname($this->configFile))) {
            $fs->mkdir(dirname($this->configFile));
        }

        if (!$fs->exists($this->configFile)) {
            $fs->touch($this->configFile);
        }

        return $this->configFile;
    }
}
