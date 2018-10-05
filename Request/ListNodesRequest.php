<?php

namespace Megawilddaddy\Linode\Request;

use Megawilddaddy\Linode\Node;
use Megawilddaddy\Linode\NodeList;

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
    public function getParams(): ?array
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
            $node->setIps($nodeConfig['ipv4']);
            $node->setLabel($nodeConfig['label']);
            $node->setRegion($nodeConfig['region']);
            $result []= $node;
        }
        return $result;
    }
}