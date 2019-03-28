<?php

namespace Model;

interface CrudInterface
{
    public function create(): int;

    public static function read(int $id);

    public static function findAll(): array;

    public function update(): bool;

    public function delete(): bool;
}