<?php
namespace AtansCommonTest\Text;

use AtansCommon\Text\String;
use PHPUnit_Framework_TestCase;

class StringTest extends PHPUnit_Framework_TestCase
{
    public function testString()
    {
        $this->assertSame(String::cut('This is a longer text', 5), 'This i...');
        $this->assertSame(String::cut('這是一個測試', 3), '這是一...');
    }
}

