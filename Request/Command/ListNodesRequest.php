<?php

namespace Megawilddaddy\Linode\Request\Command;

use Megawilddaddy\Linode\Node;
use Megawilddaddy\Linode\NodeList;
use Megawilddaddy\Linode\Request\RequestInterface;

class ListNodesRequest implements RequestInterface
{
    /**
     * @return string
     */
    public function getUrl(): string
    {
        return 'https://api.linode.com/v4/linode/instances';
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * @return array|null
     */
    public function getParams(): ?string
    {
        return null;
    }

    /**
     * @param $response
     * @return NodeList
     */
    public function buildResult($response): NodeList
    {
        $result = new NodeList();
        foreach ($response['data'] as $nodeConfig) {
            $node = new Node();
            $node->setLinodeId($nodeConfig['id']);
            $node->setIps($nodeConfig['ipv4']);
            $node->setLabel($nodeConfig['label']);
            $node->setRegion($nodeConfig['region']);
            $result []= $node;
        }
        return $result;
    }
}