<?php 


use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase {

    public function __construct() {
        parent::__construct();
        $this->validator = new Validator();
    }
    
    public function testIsObject() {
        $this->assertIsObject($this->validator);
    }

    public function testHasValidationRules() {
        $this->assertObjectHasAttribute('validation_rules', $this->validator);
    }

    public function testHasValidateMethod() {
        $this->assertTrue(method_exists($this->validator,'validate'));
    }

    public function testCanValidateValidEmail() {
        $validate = $this->validator->validate(['email' => 'test@test.com'],['email' => 'email']);
        $this->assertTrue($validate);
    }

    public function testCanValidateInvalidEmail() {
        $validate = $this->validator->validate(['email' => 'test'],['email' => 'email']);
        $this->assertFalse($validate);
    }

    public function testCanValidateRequiredField() {
        $validate = $this->validator->validate(['name' => ''],['name' => 'required']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['name' => null],['name' => 'required']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate([],['name' => 'required']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['name' => null],['name' => 'required']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['name' => 'Name'],['name' => 'required']);
        $this->assertTrue($validate);
    }

    public function testCanValidateMinRule() {
        $validate = $this->validator->validate(['password' => '1234'],['password' => 'min:6']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['amount' => 4],['amount' => 'min:6']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['data' => [4]],['data' => 'min:6']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['password' => '123456789'],['password' => 'min:6']);
        $this->assertTrue($validate);

        $validate = $this->validator->validate(['amount' => 10],['amount' => 'min:6']);
        $this->assertTrue($validate);

        $validate = $this->validator->validate(['data' => [1,2,3]],['data' => 'min:2']);
        $this->assertTrue($validate);
    }

    public function testCanValidateMaxRule() {
        $validate = $this->validator->validate(['password' => '123456789'],['password' => 'max:6']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['amount' => 10],['amount' => 'max:6']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['data' => [4,5,6]],['data' => 'max:2']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['password' => '123'],['password' => 'max:6']);
        $this->assertTrue($validate);

        $validate = $this->validator->validate(['amount' => 2],['amount' => 'max:6']);
        $this->assertTrue($validate);

        $validate = $this->validator->validate(['data' => [1,2,3]],['data' => 'max:4']);
        $this->assertTrue($validate);
    }

    public function testCanValidateArray() {
        $validate = $this->validator->validate(['data' => 'data'],['data' => 'array']);
        $this->assertFalse($validate);

        $validate = $this->validator->validate(['data' => []],['data' => 'array']);
        $this->assertTrue($validate);
    }

    

}
