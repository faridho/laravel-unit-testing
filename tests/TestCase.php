<?php

namespace Tests;

use Laravel\BrowserKitTesting\Testcase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public $baseUrl = 'http://localhost:8000';
}
