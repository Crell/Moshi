<?php

declare(strict_types=1);

namespace Crell\Moshi;

trait TestUtils
{
    protected function loadFile(string $name): string
    {
        return file_get_contents(__DIR__ . '/' . $name);
    }

}