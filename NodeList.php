<?php

namespace Megawilddaddy\Linode;

class NodeList implements \ArrayAccess, \IteratorAggregate
{
    /**
     * @var Node[]
     */
    private $nodes = [];

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->nodes);
    }

    public function offsetGet($offset)
    {
        return $this->nodes[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $offset = $offset === null ? count($this->nodes) : $offset;
        $this->nodes[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->nodes[$offset]);
    }

    public function getIterator()
    {
        return $this->nodes;
    }

    public function getNodeByIp($ip): ?Node
    {
        $nodes = array_filter($this->nodes, function (Node $node) use ($ip) {
            return in_array($ip, $node->getIps());
        });
        return reset($nodes) ?? null;
    }
}