<?php 
class Validator{
    protected $database;
    protected $errorHandler;
    private $di;
    protected $rules = ['required', 'minlength', 'maxlength', 'unique', 'email', 'phone'];
    protected $messages = [
        'required' => 'the :field field is required',
        'minlength' => 'the :field field must be a minimum of :satisfier characters',
        'maxlength' => 'the :field field must be a maximum of :satisfier characters',
        'email' => 'this is not a valid email address',
        'unique' => 'that :field is already taken',
        'phone' => 'that is not a valid phone number',
        'number' => 'The :field is not a valid number'
    ];
    public function __construct($di){
        $this->di = $di;
    }

    public function check($items, $rules){
        foreach($items as $item=>$value){
            if(in_array($item, array_keys($rules))){
                $this->validate([
                    'field' => $item,
                    'value' => $value,
                    'rules' => $rules[$item]
                ]);
            }
        }
        return $this;
    }
    public function validate($item){
        $field = $item['field'];
        foreach($item['rules'] as $rule => $satisfier){
            if(!call_user_func_array([$this, $rule], [$field, $item['value'], $satisfier])){
                //error handling
                $this->di->get('errorhandler')->addError(str_replace([':field', ':satisfier'], [$field, $satisfier], $this->messages[$rule]), $field);
            }
        }
    }
    public function required($field, $value, $satisfier){
        return !empty(trim($value));
    }
    public function minlength($field, $value, $satisfier){
        return mb_strlen($value) >= $satisfier;
    }
    public function maxlength($field, $value, $satisfier){
        return mb_strlen($value) <= $satisfier;
    }
    public function unique($field, $value, $satisfier){
        return !$this->di->get('database')->exists($satisfier, [$field=>$value]);
    }
    public function email($field, $value, $satisfier){
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    public function number($field, $value, $satisfier) {
        return is_numeric($value);
    }
    
    public function phone($field, $value, $satisfier){
        return strlen(preg_replace('/^[0-9]{10}/', '', $value)) == 10;
    }
    public function fails(){
        return $this->di->get('errorhandler')->hasErrors();
    }
    public function errors(){
        return $this->di->get('errorhandler');
    }
}
?>