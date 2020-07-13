<?php

require_once __DIR__."/../helper/requirements.php";

class Address{
    private $table = "address";
    private $database;
    protected $di;
    
    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->database = $this->di->get('database');
    }
    
    private function validateData($data)
    {
        $validator = $this->di->get('validator');
        return $validator->check($data, [
            'street' => [
                'required' => true,
                'minlength' => 2,
                'maxlength' => 10,
                'unique' => $this->table
            ],
            'city' => [
                'required' => true,
                'minlength' => 2,
                'maxlength' => 10,
                'unique' => $this->table
            ],
            'pincode' => [
                'required' => true,
                'minlength' => 10,
                'maxlength' => 10,
                'unique' => $this->table
            ],
            'country' => [
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255,
                'unique' => $this->table
            ],
            'town' => [
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255,
                'unique' => $this->table
            ],
            'block_no' => [
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255,
                'unique' => $this->table
            ]
        ]);
    }
    /**
     * This function is responsible to accept the data from the Routing and add it to the Database.
     */
    public function addAddress($data)
    {
        $validation = $this->validateData($data);
        if(!$validation->fails())
        {
            //Validation was successful
            try
            {
                //Begin Transaction
                $this->database->beginTransaction();
                $data_to_be_inserted = [
                    'street' => $data['street'],
                    'city' => $data['city'],
                    'pincode' => $data['pincode'],
                    'state' => $data['state'],
                    'country' => $data['country'],
                    'town' => $data['town'],
                    'block_no' => $data['block_no']
                ];
                $category_id = $this->database->insert($this->table, $data_to_be_inserted);
                $this->database->commit();
                return ADD_SUCCESS;
            }
            catch(Exception $e)
            {
                $this->database->rollback();
                return ADD_ERROR;
            }
        }
        else
        {
            //Validation Failed!
            return VALIDATION_ERROR;
        }
    }
}