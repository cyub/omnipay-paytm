<?php

namespace Omnipay\Paytm\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return true;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->getRequest()->getEndpoint('Purchase');
    }

    public function getRedirectData()
    {
        return $this->getRequest()->getData();
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }
}
