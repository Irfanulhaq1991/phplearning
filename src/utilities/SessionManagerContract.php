<?php

namespace Irfan\Phplearning\utilities;

interface SessionManagerContract
{
    public function startSession(): void;

    public function saveValue(string $key, string $value): void;

    public function getValue(string $key): string;

    public function clear();
}