<?php

declare(strict_types=1);

namespace Revolution\Salvager\Contracts;

interface Factory
{
    public function browse(callable $callback): void;
}
