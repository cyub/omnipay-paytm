# Omnipay: Paytm

**Paytm driver for the Omnipay PHP payment processing library**


[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Paytm support for Omnipay.


## Usage

### Begin Transaction 
```php
$gateway = Omnipay::create('Paytm_Express');

$gateway->setMid('TRANSS******');
$gateway->setKey('6u*****');
$gateway->setIndustryTypeId('Retail');
$gateway->setChannelId('WEB');
$gateway->setWebSite('WEB_STAGING');
$gateway->setEnvironment('staging');


$params = [
	'orderId' => 'ORDS83028539',
	'CustID' => 'CUST001',
	'amount' => 1
];
$response = $gateway->purchase($params)->send();

$response->redirect();
```

### Transaction Notify
```php
$gateway = Omnipay::create('Paytm_Express');
$gateway->setMid('TRANSS********');
$gateway->setKey('6u*******');

$response = $gateway->completePurchase(['request_params' => $_REQUEST])->send();
if ($response->isPaid()) { // 成功
...
} elseif ($response->isFailure()) { // 失败
...
} else { // 进行中
...
}
```

### Order Query
```php
$gateway = Omnipay::create('Paytm_Express');
$gateway->setMID('TRANSS********');

$response = $gateway->queryOrder(['orderId' => 'xxx'])->send();
if ($response->isPaid()) {
...
} elseif ($response->isFailure()) {
...
} else {
...
}
```