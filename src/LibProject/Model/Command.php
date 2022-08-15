<?php

namespace LibProject\Model;

use LibProject\Model\Resource\Command as CommandResource;

class Command extends AbstractModel
{
    public const NAME = 'name';
    public const ARGUMENTS = 'arguments';
    public const OPTIONS = 'options';

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var array
     */
    protected array $arguments;

    /**
     * @var array
     */
    protected array $options;

    /**
     * Command constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    protected function init()
    {
        $this->resource = CommandResource::class;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->setData(self::NAME, $name);

        return $this;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->getData(self::ARGUMENTS);
    }

    /**
     * @param array $arguments
     * @return $this
     */
    public function setArguments(array $arguments): self
    {
        $this->setData(self::ARGUMENTS, $arguments);

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->getData(self::OPTIONS);
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->setData(self::OPTIONS, $options);

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $data = [
            'name' => $this->getName(),
            'arguments' => $this->getArguments(),
            'options' => $this->getOptions(),
        ];

        $result = json_encode($data);

        return $result;
    }
}