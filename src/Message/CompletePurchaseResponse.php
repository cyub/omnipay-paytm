<?php

namespace Omnipay\Paytm\Message;

use Omnipay\Common\Message\AbstractResponse;

class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * 签名验证是否成功
     *
     * @return boolean
     */
    public function isVerifySuccess()
    {
        if (isset($this->data['verify_success'])) {
            return $this->data['verify_success'];
        }
    }

    public function isSuccessful()
    {
        if (isset($this->data['verify_success'])) {
            return $this->data['verify_success'];
        }
    }

    /**
     * 是否支付成功
     *
     * @return boolean
     */
    public function isPaid()
    {
        if (isset($this->data['is_paid'])) {
            return $this->data['is_paid'];
        }
    }

    /**
     * 是否支付失败
     *
     * @return boolean
     */
    public function isFailure()
    {
        if (isset($this->data['is_failure'])) {
            return $this->data['is_failure'];
        }
    }

    /**
     * 是否支付进行中
     *
     * @return boolean
     */
    public function isPending()
    {
        if (isset($this->data['is_pending'])) {
            return $this->data['is_pending'];
        }
    }

    /**
     * 获取支付状态
     *
     * @return string
     */
    public function getPurchaseStatus()
    {
        if (isset($this->data['STATUS'])) {
            return $this->data['STATUS'];
        }
    }

    /**
     * 获取支付金额
     */
    public function getPaidAmount()
    {
        if (isset($this->data['TXNAMOUNT'])) {
            return $this->data['TXNAMOUNT'];
        }
    }

    /**
     * 获取订单号
     *
     * @return string
     */
    public function getOrderId()
    {
        if (isset($this->data['ORDERID'])) {
            return $this->data['ORDERID'];
        }
    }

	/**
     * 获取支付网关订单号
     */
    public function getPaymentOrderId()
    {
        if (isset($this->data['TXNID'])) {
            return $this->data['TXNID'];
        }
    }

    /**
     * 获取支付币种
     *
     * @return string
     */
    public function getCurrency()
    {
        if (isset($this->data['CURRENCY'])) {
            return $this->data['CURRENCY'];
        }
    }

    /**
     * 获取支付日期
     *
     * @return string
     */
    public function getPaidDate()
    {
        if (isset($this->data['TXNDATE'])) {
            return $this->data['TXNDATE'];
        }
    }
}
