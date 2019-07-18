<?php

namespace Akaunting\Firewall\Tests\Feature;

use Akaunting\Firewall\Middleware\Rfi;
use Akaunting\Firewall\Tests\TestCase;

class RfiTest extends TestCase
{
    public function testShouldPass()
    {
        $this->assertEquals('next', (new Rfi())->handle($this->request, $this->getNextClosure()));
    }

    public function testShouldFail()
    {
        $this->request->query->set('foo', 'https://attacker.example.com/evil.php');

        $this->assertEquals('403', (new Rfi())->handle($this->request, $this->getNextClosure())->getStatusCode());
    }
}