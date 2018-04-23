<?php

namespace Omnipay\Paytm\Message;

use Omnipay\Paytm\Common\ResponseParser;

class QueryOrderRequest extends AbstractRequest
{
    
    public function getData()
    {
        $this->validate('MID', 'ORDER_ID');
        $data = [
            'MID' => $this->getMid(),
            'ORDERID' => $this->getOrderId(),
        ];

        $data['CHECKSUMHASH'] = $this->generateSign($data);

        return $data;
    }

    public function sendData($data)
    {
        $endpoint = $this->getEndPoint('OrderQuery');
        $queryParams = [
            'JsonData' => json_encode($data)
        ];
        $url = $endpoint . '?' . http_build_query($queryParams);
        $response = $this->httpClient->request('GET', $url);

        return $this->response = new QueryOrderResponse($this, ResponseParser::json($response));
    }
}