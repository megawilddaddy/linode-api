<?php

namespace Megawilddaddy\Linode\Request;

interface RequestInterface
{
    public function getUrl(): string;

    public function getMethod(): string;

    public function getParams(): ?array;

    public function buildResult($response);
}