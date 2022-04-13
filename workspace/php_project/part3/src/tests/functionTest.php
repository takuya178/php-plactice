<?php

use PHPUnit\Framework\TestCase;
require_once(__DIR__ . '/../lib/function.php');

class functionTest extends TestCase {

    // testと書かなければエラーになる
    public function testShowDown() {
        $this->assertSame(['3', '10', 'A'], convertToNumber('H3', 'S10', 'DA'));
    }
}