<?php

namespace Megawilddaddy\Linode\Request;

use Megawilddaddy\Linode\Node;

abstract class AbstractNodeRequest
{
    /**
     * @var Node
     */
    private $node;

    /**
     * AbstractNodeRequest constructor.
     * @param Node $node
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * @return Node
     */
    public function getNode(): Node
    {
        return $this->node;
    }

    /**
     * @param Node $node
     */
    public function setNode(Node $node): void
    {
        $this->node = $node;
    }

    /**
     * @param $response
     * @return mixed
     */
    public function buildResult($response)
    {
        return $response;
    }
}