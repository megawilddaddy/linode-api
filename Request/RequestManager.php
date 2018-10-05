<?php

namespace Megawilddaddy\Linode\Request;

class RequestManager
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * RequestManager constructor.
     * @param string $accessToken
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param RequestInterface $request
     * @return mixed
     */
    public function request(RequestInterface $request)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request->getMethod());
        curl_setopt($ch, CURLOPT_URL, $request->getUrl());
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type:application/json",
            sprintf("Authorization: Bearer %s", $this->accessToken)
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $params = $request->getParams();
        if ($params) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }

        $res = curl_exec ($ch);
        curl_close ($ch);

        $decoded = json_decode($res, true);
        return $request->buildResult($decoded);
    }
}