<?php

namespace Megawilddaddy\Linode\Request\Command;

use Megawilddaddy\Linode\Request\AbstractNodeRequest;
use Megawilddaddy\Linode\Request\RequestInterface;

class ShutdownRequest extends AbstractNodeRequest implements RequestInterface
{
    public function getUrl(): string
    {
        return sprintf('https://api.linode.com/v4/linode/instances/%s/shutdown',
            $this->getNode()->getLinodeId());
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getParams(): ?string
    {
        return null;
    }
}