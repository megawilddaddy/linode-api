<?php

namespace Megawilddaddy\Linode\Request;

use Megawilddaddy\Linode\Node;

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
        return sprintf('https://api.linode.com/v4/linode/instances/%s/reboot', $this->getNode()->getLinodeId());
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getParams(): ?array
    {
        return json_encode([
            'region' => $this->node1->getRegion(),
            'assignments' => [
                ['address' => $this->node1->getMainIp(), 'linode_id' => $this->node2->getLinodeId()],
                ['address' => $this->node2->getMainIp(), 'linode_id' => $this->node1->getLinodeId()],
            ]
        ]);
    }

    public function buildResult($response)
    {
        return $response;
    }
}