<?php 


use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase {

    public function testCanInitValidator() {
        $validator = new Validator();
        $this->assertIsObject($validator);
    }
}
