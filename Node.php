<?php

namespace Megawilddaddy\Linode;

class Node
{
    /**
     * @var integer
     */
    private $linodeId;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string[]
     */
    private $ips = [];

    /**
     * @var string
     */
    private $region;

    /**
     * @return int
     */
    public function getLinodeId(): int
    {
        return $this->linodeId;
    }

    /**
     * @param int $linodeId
     */
    public function setLinodeId(int $linodeId): void
    {
        $this->linodeId = $linodeId;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string[]
     */
    public function getIps(): array
    {
        return $this->ips;
    }

    /**
     * @param string[] $ips
     */
    public function setIps(array $ips): void
    {
        $this->ips = $ips;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getMainIp()
    {
        var_dump($this->getIps());
        die();
    }
}