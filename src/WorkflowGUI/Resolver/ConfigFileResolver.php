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

namespace CORS\Pimcore\WorkflowGui\Resolver;

use Symfony\Component\Filesystem\Filesystem;

class ConfigFileResolver implements ConfigFileResolverInterface
{
    public function __construct(
        protected string $configFile,
    ) {
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
