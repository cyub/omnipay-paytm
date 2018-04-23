<?php

namespace Omnipay\Paytm\Message;

use Omnipay\Common\Message\AbstractResponse;
use Exception;

class QueryOrderResponse extends AbstractResponse
{
    protected $dataParsed = false;
    protected $dataParse = [];

    public function isSuccessful()
    {
        return $this->getOrderStatus() == 'TXN_SUCCESS';
    }

    public function isPaid()
    {
        return $this->getOrderStatus() == 'TXN_SUCCESS';
    }

    public function isFailure()
    {
        return $this->getOrderStatus() == 'TXN_FAILURE';
    }

    public function isPending()
    {
        return $this->getOrderStatus() == 'PENDING';
    }

    public function getOrderStatus()
    {
        if (isset($this->data['STATUS'])) {
            return $this->data['STATUS'];
        }
    }

    public function getOrderId()
    {
        if (isset($this->data['ORDERID'])) {
            return $this->data['ORDERID'];
        }
    }

    public function getPaymentOrderId()
    {
        if (isset($this->data['TXNID'])) {
            return $this->data['TXNID'];
        }
    }

    public function getPaidAmount()
    {
        if (isset($this->data['TXNAMOUNT'])) {
            return $this->data['TXNAMOUNT'];
        }
    }

    public function getPaidDate()
    {
        if (isset($this->data['TXNDATE'])) {
            return $this->data['TXNDATE'];
        }
    }
}