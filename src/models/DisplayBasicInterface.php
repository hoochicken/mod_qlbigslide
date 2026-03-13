<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

use Joomla\Registry\Registry;
use stdClass;

interface DisplayBasicInterface
{
    /**
     * @return array{ message: string, params: Registry, module: stdClass, errors: ErrorModel[] }
     */
    public function toArray(): array;

    public function showTitle(): bool;

    public function getHeaderTag(): string;

    public function getModuleTag(): string;

    public function getModuleClassSuffix(bool $specialChars = true): string;

    public function getParams(): ?Registry;

    public function setParams(?Registry $params): void;

    public function getModule(): ?stdClass;

    public function setModule(?stdClass $module): void;

    public function getMessage(): ?string;

    public function setMessage(?string $message): void;

    public function hasErrors(): bool;

    public function getErrors(): array;

    public function setErrors(array $errors): void;
}
