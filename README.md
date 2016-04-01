# Org_Heigl\Psr7Wrapper

A library to mimick PSR7 behaviours to Request- or
Response-Objects of different Frameworks.

During my work I came accross the need to wrap a ZendFramework1-Request into a
PSR7-Request. As I couldn't find a lib that did that I had to write my own one.

## Installation

```bash
composer require org_heigl/psr7wrapper
```

## Usage

```php
use Org_Heigl\Psr7Wrapper\Wrapper\Zf1\RequestWrapper;
use Org_Heigl\Psr7Wrapper\Wrapper\Zf1\ResponseWrapper;

class DemoController Extends Zend_Controller_Abstract
{
    public function testAction()
    {
        $request = new RequestWrapper($this->getRequest());
        $request = new ResponseWrapper($this->getResponse());
    }
}
```

