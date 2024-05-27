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

namespace CORS\Pimcore\WorkflowGui\Repository;

interface WorkflowRepositoryInterface
{
    public function findAll(): array;

    public function find($id): array;

    public function updateConfig(callable $workflowsRewriter): void;
}
