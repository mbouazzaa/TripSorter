<?php


namespace tests;


use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();
    }

    public function tearDown()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::tearDown();
    }

}