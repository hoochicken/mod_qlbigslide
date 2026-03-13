<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

use Joomla\Registry\Registry;
use stdClass;

class DisplayModel extends DisplayInterface
{
    public ?Registry $params = null;
    public ?stdClass $module = null;
    public ?string $message = null;
    /** @var ErrorModel[] */
    public array $errors = [];

    public function __construct(Registry $params, stdClass $module)
    {
        $this->params = $params;
        $this->module = $module;
    }

    protected function toArray(): array
    {
        return [
            'message' => $this->message,
            'params' => $this->params,
            'module' => $this->module,
            'errors' => $this->errors,
        ];
    }

    public function showTitle(): bool
    {
        return (bool)$this->params->get('show_title', 1);
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function getParams(): ?Registry
    {
        return $this->params;
    }

    public function setParams(?Registry $params): void
    {
        $this->params = $params;
    }

    public function getModule(): ?stdClass
    {
        return $this->module;
    }

    public function setModule(?stdClass $module): void
    {
        $this->module = $module;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }
}
