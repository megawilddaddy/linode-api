<?php

namespace Megawilddaddy\Linode\Request\Command;

use Megawilddaddy\Linode\Node;
use Megawilddaddy\Linode\Request\RequestInterface;

class SwapIpsRequest implements RequestInterface
{
    /**
     * @var Node
     */
    private $node1;

    /**
     * @var Node
     */
    private $node2;

    public function __construct(Node $node1, Node $node2)
    {
        $this->node1 = $node1;
        $this->node2 = $node2;
    }

    public function getUrl(): string
    {
        return 'https://api.linode.com/v4/networking/ipv4/assign';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getParams(): ?string
    {
        return json_encode([
            'region' => $this->node1->getRegion(),
            'assignments' => [
                ['address' => $this->node1->getExternalIp(), 'linode_id' => $this->node2->getLinodeId()],
                ['address' => $this->node2->getExternalIp(), 'linode_id' => $this->node1->getLinodeId()],
            ]
        ]);
    }

    public function buildResult($response)
    {
        return $response;
    }
}