<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

class ErrorCollection
{
    /** @var ErrorItem[] */
    private array $items = [];

    public function add(ErrorItem $error): void
    {
        $this->items[] = $error;
    }

    /**
     * @param ErrorItem[] $errors
     */
    public function set(array $errors): void
    {
        $this->items = $errors;
    }

    /**
     * @return ErrorItem[]
     */
    public function get(): array
    {
        return $this->items;
    }

    public function hasErrors(): bool
    {
        return 0 < count($this->items);
    }
}

