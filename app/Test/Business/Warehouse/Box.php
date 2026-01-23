<?php

namespace App\Test\Business\Warehouse;

class Box
{
    private string $id;

    private int $weight;

    private array $size; //xyz

    /**
     * @param string $id
     * @param int $weight
     * @param array $size
     */
    public function __construct(string $id, int $weight, array $size)
    {
        $this->id = $id;
        $this->weight = $weight;
        $this->size = $size;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getSize(): array
    {
        return $this->size;
    }


}
