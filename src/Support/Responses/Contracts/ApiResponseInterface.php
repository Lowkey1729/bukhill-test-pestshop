<?php

namespace Support\Responses\Contracts;

interface ApiResponseInterface
{
    public function getResponseBlock();

    public function getStatusCode();
}
