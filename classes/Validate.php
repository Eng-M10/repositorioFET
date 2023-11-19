<?php

class Validate
{

    private $_passed = false;
    private $_errors = array();
    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = $source[$item];
                $item = escape($item);
                if ($rule === 'required' && empty($value)) {
                    $this->addError("Preencha o campo {$item}");
                } else if(!empty($value)) {
                    switch ($rule) { 
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("<p>{$item} precisa de no minimo {$rule_value} caracteres ");
                            } 
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} nao pode ultrapassar {$rule_value} caracteres");
                            } 
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} deve coincidir com {$item}");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count()) {
                                $this->addError("{$item} ja  existe.");
                            }
                            break;
                        case 'email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError("{$item} nao e um email valido");
                            }
                            break;
                        case 'file':
                                if (!isset($value['name']) || empty($value['name'])) {
                                    $this->addError("Selecione um arquivo para o campo {$item}");
                                }
                                break;
                        
                    }
                }
            }
        }

        if (empty($this->errors())) {
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }
}

/*
php v5.* -> empty($this->_errors)
php v^5.* -> empty($this->errors())
*/