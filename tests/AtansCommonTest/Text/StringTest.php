<?php
namespace AtansCommonTest\Text;

use AtansCommon\Text\String;
use PHPUnit_Framework_TestCase;

class StringTest extends PHPUnit_Framework_TestCase
{
    public function testCut()
    {
        $this->assertSame('This i...', String::cut('This is a longer text', 6), 'Test cut englist');
        $this->assertSame('這是一...', String::cut('這是一個測試', 3), 'Test cut chinese');
        $this->assertSame('這是一..', String::cut('這是一個測試', 3, '..'), 'Test cut append');
    }

    public function testSub()
    {
        $this->assertSame('is is a', String::sub('This is a longer text', 2, 7), 'Test sub english');
        $this->assertSame('一個測', String::sub('這是一個測試', 2, 3), 'Test sub chinese');
    }
}

