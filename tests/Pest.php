<?php

declare(strict_types=1);

function loadFixture(string $name): string
{
    return file_get_contents(__DIR__ . "/Fixtures/$name.json");
}
