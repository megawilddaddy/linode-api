<?php

namespace Megawilddaddy\Linode\Request;

class RebootRequest extends AbstractNodeRequest implements RequestInterface
{
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
        return null;
    }
}