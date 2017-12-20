# Client SOAP and RestFull

Create declaration with Place to Pay.

Installation
--

```bash
composer require freddiegar/declarations-api:^1.0.0
```

Need help
--

Going to 

```
https://localhost/declarations-api/examples/index.php 
// or
https://localhost/declarations-api/examples/index.php?CompanyRegister/link
```
 
Example Service Class
--

```php
<?php

namespace App\Contracts\Incomes;

use FreddieGar\DeclarationApi\Exceptions\DeclarationApiException;
use FreddieGar\DeclarationApi\Models\Service;

class IncomeRequestService extends Service
{

    public function __construct(array $options = [])
    {
        if (empty($options['url'])) {
            throw new DeclarationApiException('Set url service');
        }

        if (empty($options['login'])) {
            throw new DeclarationApiException('Set login service use');
        }

        if (empty($options['password'])) {
            throw new DeclarationApiException('Set password service use');
        }

        if (empty($options['action'])) {
            throw new DeclarationApiException('Set action execute in service');
        }

        if (empty($options['data'])) {
            throw new DeclarationApiException('Set data to send');
        }

        $this->url($options['url'])
            ->login($options['login'])
            ->password($options['password'])
            ->action($options['action'])
            ->data($options['data']);

        foreach (['url', 'login', 'password', 'action', 'data'] as $option) {
            unset($options[$option]);
        }

        // Extra options @see FreddieGar\DeclarationApi\Constants\Command;
        // $options[] = Command::REQUEST;
        // $options[] = Command::NO_CALL;

        parent::__construct($options);
    }

    protected function setResponse($response = null, $escapeHtml = true, $append = true)
    {
        $this->response($response);

        return $this;
    }
}
```

Use it
--

```php
$options = [];
$options['login'] = 'loginServiceSecret';
$options['password'] = 'passworServiceSecret';
$options['url'] = 'https://url.service.provider';
$options['action'] = ActionInterface::ACTION_CREATE_REQUEST;
$options['data'] = $data; // Payload with request

try {
    $service = new IncomeRequestService($options);
    var_dump($service->call()->response()); // Service reponse
} catch (DeclarationApuException $e) {
    return 'Exception: ' . $e->getMessage(); // Service error
}
```

That's all! :P