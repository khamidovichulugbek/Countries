<?php

namespace App\Kernel\Validation;


class Validation
{

    private array $errors = [];
    private array $data;


    public function validate(array $data, array $rules)
    {   
        $errors = null;
        $this->data = $data;
        // [name => 'sasa']
        //[name => ['required, 'min:3']]
        foreach ($rules as $key => $rule) {
            $rules = $rule;
            foreach ($rules as $rule) {
                $rule = explode(":", $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $errors = $this->validateRule($key, $ruleName, $ruleValue);
                if ($errors){
                    $this->errors[$key][] = $errors;
                }
            }
        }
        return empty($this->errors);
    }

    public function errors(){
        return $this->errors;
    }

    private function validateRule($key, $ruleName, $ruleValue)
    {
        $value = $this->data[$key];

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    return "Ushbu qatorni to'ldirish majburiy";
                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue) {
                    return "Ushbu qatorning minimal uzunligi $ruleValue tadan iborat bo'lishi kerak";
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue) {
                    return "Ushbu qatorning minimal uzunligi $ruleValue tadan iborat bo'lishi kerak";
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return "Iltimos email kirgizing";
                }
                break;
            case 'confirm':
                if($value !== $this->data["{$key}_confirmation"]) {
                    return "Parollar bir biriga mos emas !";
                }
                break;
        }
        return false;
    }
}
