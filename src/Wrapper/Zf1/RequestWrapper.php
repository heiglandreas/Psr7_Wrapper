<?php

/**
 * Copyright (c) 2016-2016} Andreas Heigl<andreas@heigl.org>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2016-2016 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     30.03.2016
 * @link      http://github.com/heiglandreas/Psr7Wrapper
 */

namespace Org_Heigl\Psr7Wrapper\Wrapper\Zf1;

use League\Uri\Schemes\Http as HttpUri;
use Org_Heigl\Psr7Wrapper\Wrapper\AbstractRequestWrapper;


class RequestWrapper extends AbstractRequestWrapper
{
    /**
     * @var \Zend_Controller_Request_Http
     */
    protected $request;

    public function __construct(\Zend_Controller_Request_Http $request)
    {
        $this->request = $request;
        $this->headers = [];
        $this->body    = new StreamWrapper($request->getRawBody());
        $this->method  = $this->request->getMethod();
        $this->uri     = HttpUri::createFromString($this->request->getRequestUri());
        $this->protocolVersion = implode('/', $this->request->getServer('SERVER_PROTOCOL'))[1];

        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $header = implode('-', array_map(function($item){
                    return ucfirst(strtolower($item));
                }), explode('_', str_replace('HTTP_', '', $key)));
                $this->headers[$header][] = $value;
            }
        }
    }
}
