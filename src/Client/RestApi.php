<?php

namespace Now\Client;

class RestApi extends Table
{

    public function restApiGet($nameSpace,$apiName, $endPointName, $queryParameters)
    {
        $queryString = $this->getQueryString($queryParameters);
        $response = $this->client->get('/api/' .
            $nameSpace .  '/' .
            $apiName . '/' .
            $endPointName . '?' .
            $queryString,
            ['headers' => $this->getHeaders()]);

        return json_decode($response->getBody());
    }

    public function getQueryString($queryParameters)
    {
        $queryString = '';
        $operator = '';
        foreach ($queryParameters as $queryParameter => $queryValue) {
            $queryString = $queryString . $operator . $queryParameter . '=' . $queryValue;
            $operator = '&';
        }
        return $queryString;
    }
}