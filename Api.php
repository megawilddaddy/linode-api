<?php

namespace Megawilddaddy\Linode;

use Megawilddaddy\Linode\Request\Command\ListNodesRequest;
use Megawilddaddy\Linode\Request\Command\RebootRequest;
use Megawilddaddy\Linode\Request\Command\ShutdownRequest;
use Megawilddaddy\Linode\Request\Command\SwapIpsRequest;
use Megawilddaddy\Linode\Request\RequestManager;

use Megawilddaddy\Linode\Request\RequestInterface;

use Psr\Log\LoggerInterface;

class Api
{
    /**
     * @var RequestManager
     */
    private $requestManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Api constructor.
     * @param $accessToken
     */
    public function __construct(string $accessToken)
    {
        $this->requestManager = new RequestManager($accessToken);
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @param $masterIp
     * @param $failoverIp
     */
    public function failover($masterIp, $failoverIp): void
    {
        /** @var NodeList $nodes */
        $this->log("Requesting nodes");
        $nodes = $this->fire(new ListNodesRequest());

        $masterNode = $nodes->getNodeByIp($masterIp);
        $this->log("Master node: {$masterNode->getLabel()} {$masterNode->getExternalIp()}");

        $failoverNode = $nodes->getNodeByIp($failoverIp);
        $this->log("Failover node: {$masterNode->getLabel()} {$masterNode->getExternalIp()}");

        $this->log("Swapping ips");
        $this->fire(new SwapIpsRequest($masterNode, $failoverNode));

        $this->log("Shutting down master node");
        $this->fire(new ShutdownRequest($masterNode));

        $this->log("Rebooting failover node");
        $this->fire(new RebootRequest($failoverNode));

        $this->log("Done");
    }

    /**
     * @param RequestInterface $request
     * @return mixed
     */
    protected function fire(RequestInterface $request)
    {
        return $this->requestManager->request($request);
    }

    /**
     * @param $msg
     */
    protected function log(string $msg): void
    {
        if ($this->logger) {
            $this->logger->debug("\n" . $msg);
        }
    }
}