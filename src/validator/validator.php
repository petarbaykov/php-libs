<?php 

/**
 * Data validator class
 */
class Validator {

    private $validation_rules = ["required", "email", "min", "max", "string", "boolean", "date", "file", "array", "numeric"];

    public function validate($data, $rules, $messages = []) {
        $valid = false;
        
        foreach($rules as $key => $rule) {
            $rules_arr = explode("|", $rule);
            foreach($rules_arr as $single_rule) {
                $rule_params = explode(":",$single_rule);
                $rule_name = $rule_params[0];
                $rule_condition = isset($rule_params[1]) ? $rule_params[1] : false;

                if(in_array($rule_name, $this->validation_rules)) {
                    if($rule_name === "required") {
                        if($this->empty($data[$key])) {
                            return false;
                        }
                    }
                }
            }
        }

        return $valid;
    }

    private function empty($value) {
        if(empty($value) || $value === "" || $value == "" || $value === null) {
            return true;
        }

        return false;
    }
    
}
?>