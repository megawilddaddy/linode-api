<?php

namespace Megawilddaddy\Linode;

use Megawilddaddy\Linode\Request\ListNodesRequest;
use Megawilddaddy\Linode\Request\RebootRequest;
use Megawilddaddy\Linode\Request\RequestInterface;
use Megawilddaddy\Linode\Request\ShutdownRequest;
use Megawilddaddy\Linode\Request\SwapIpsRequest;

class Api
{
    /**
     * @var RequestManager
     */
    private $requestManager;

    /**
     * Api constructor.
     * @param $accessToken
     */
    public function __construct(string $accessToken)
    {
        $this->requestManager = new RequestManager($accessToken);
    }

    /**
     * @param $masterIp
     * @param $failoverIp
     */
    public function failover($masterIp, $failoverIp)
    {
        /** @var NodeList $nodes */
        $nodes = $this->fire(new ListNodesRequest());

        $masterNode = $nodes->getNodeByIp($masterIp);
        $failoverNode = $nodes->getNodeByIp($failoverIp);

        $this->fire(new SwapIpsRequest($masterNode, $failoverNode));

        $this->fire(new ShutdownRequest($masterNode));

        $this->fire(new RebootRequest($failoverNode));
    }

    /**
     * @param RequestInterface $request
     * @return mixed
     */
    private function fire(RequestInterface $request)
    {
        return $this->requestManager->request($request);
    }
}