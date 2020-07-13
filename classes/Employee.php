<?php

require_once __DIR__."/../helper/requirements.php";

class Employee{
    private $table = "employees";
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
            'first_name' => [
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255,
                'unique' => $this->table
            ],
            'last_name' => [
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255,
                'unique' => $this->table
            ],
            'phone_no' => [
                'required' => true,
                'minlength' => 10,
                'maxlength' => 10,
                'unique' => $this->table
            ],
            'email_id' => [
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255,
                'unique' => $this->table
            ],
            
        ]);
    }
    /**
     * This function is responsible to accept the data from the Routing and add it to the Database.
     */
    public function addEmployee($data)
    {
        $validation = $this->validateData($data);
        if(!$validation->fails())
        {
            //Validation was successful
            try
            {
                //Begin Transaction
//                Util::dd($data);
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
                $address_id = $this->database->insert("address",$data_to_be_inserted);
                $data_to_be_inserted = [
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'phone_no' => $data['phone_no'],
                    'email_id' => $data['email_id'],
                    'gender' => $data['gender'],
                    'address_id' => $address_id

                ];
                $employee_id = $this->database->insert($this->table, $data_to_be_inserted);
                $this->database->commit();
                return ADD_SUCCESS;
            }
            catch(Exception $e)
            {
                Util::dd($e);
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
    public function getJSONDataForDataTable($draw,$searchParameter,$orderBy,$start,$length)
    {
        $columns = ["sr_no","first_name","last_name", "phone_no", "email_id", "gender"];
        $totalRowCountQuery = "SELECT COUNT(id) as total_count FROM {$this->table} WHERE deleted=0";
        $filteredRowCountQuery = "SELECT COUNT(id) as filtered_total_count FROM {$this->table} WHERE deleted=0";
        $query = "SELECT * FROM {$this->table} WHERE deleted=0";
        
        if($searchParameter!=null)
        {
            $query .= " AND first_name like '%{$searchParameter}%' OR last_name like '%{$searchParameter}%' OR phone_no like '%{$searchParameter}%' OR email_id like '%{$searchParameter}%' OR gender like '%{$searchParameter}%'";
            $filteredRowCountQuery .= " AND first_name like '%{$searchParameter}%' OR last_name like '%{$searchParameter}%' OR phone_no like '%{$searchParameter}%' OR email_id like '%{$searchParameter}%' OR gender like '%{$searchParameter}%'";
        }
        if($orderBy != null)
        {
            $query .= " ORDER BY {$columns[$orderBy[0]['column']]} {$orderBy[0]['dir']}";
        }
        else
        {
            $query .= " ORDER BY {$columns[0]} ASC";
        }
        if($length != -1)
        {
            $query .= " LIMIT {$start},{$length}";
        }
        
        $totalRowCountResult = $this->database->raw($totalRowCountQuery);
        $numberOfTotalRows = is_array($totalRowCountResult) ? $totalRowCountResult[0]->total_count : 0;
        
        $filteredRowCountResult = $this->database->raw($filteredRowCountQuery);
        $numberOfFilteredRows = is_array($filteredRowCountResult) ? $filteredRowCountResult[0]->filtered_total_count : 0;
        
        $filteredData = $this->database->raw($query);
        $numberOfRowsToDisplay = is_array($filteredData) ? count($filteredData) : 0;
        $data = [];
        for($i=0; $i<$numberOfRowsToDisplay; $i++)
        {
            $subarray = [];
            $subarray[] = $i+1;
            $subarray[] = $filteredData[$i]->first_name;
            $subarray[] = $filteredData[$i]->last_name;
            $subarray[] = $filteredData[$i]->phone_no;
            $subarray[] = $filteredData[$i]->email_id;
            $subarray[] = $filteredData[$i]->gender;
            $subarray[] = <<<BUTTONS
            <button class='edit btn btn-outline-primary' id='{$filteredData[$i]->id}' data-toggle="modal" data-target="#editModal"><i class='fas fa-pencil-alt'></i></button>
            <button class='delete btn btn-outline-danger' id='{$filteredData[$i]->id}' data-toggle="modal" data-target="#deleteModal"><i class='fas fa-trash'></i></button>
BUTTONS;
            $data[] = $subarray;
            
        }
        $output = array(
            "draw"=>$draw,
            "recordsTotal"=>$numberOfTotalRows,
            "recordsFiltered"=>$numberOfFilteredRows,
            "data"=>$data
        );
        
        echo json_encode($output);
    }
    
    public function getEmployeeById($employeeId, $mode=PDO::FETCH_OBJ)
    {
        $query = "SELECT * FROM {$this->table} wHERE deleted=0 AND id = {$employeeId}";
        $result = $this->database->raw($query,$mode);
//        Util::dd($result);
        return $result;
    }
    
    public function update($data,$id)
    {
        $validationData['first_name'] = $data['employee_first_name'];
    //    $validationData['last_name'] = $data['employee_last_name'];
    //    $validationData['gst_no'] = $data['employee_gst_no'];
        $validation = $this->validateData($validationData);
        if(!$validation->fails())
        {
            try{
                $this->database->beginTransaction();
            //    Util::dd($validationData);
                $filteredData['first_name'] = $data['employee_first_name'];
                $this->database->update($this->table,$filteredData,"id={$id}");
                $this->database->commit();
                return EDIT_SUCCESS;
                
            }catch(Exception $e){
                $this->database->rollback();
                return EDIT_ERROR;
            }
        }
        else
        {
            return VALIDATION_ERROR;
        }
        // Util::dd($validationData);

    }
    
    public function delete($id)
    {
        try{
            $this->database->beginTransaction();
//            Util::dd($id);
            $this->database->delete($this->table,"id={$id}");
//            Util::dd($id);
            $this->database->commit();
            return DELETE_SUCCESS;
        }catch(Exception $e){
//            Util::dd($e);
            $this->database->rollback();
            return DELETE_ERROR;
        }
    }
}