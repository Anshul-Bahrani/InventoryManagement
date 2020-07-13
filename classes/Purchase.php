<?php

require_once __DIR__."/../helper/requirements.php";

class Purchase{
    private $table = "purchase";
    private $database;
    protected $di;
    
    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->database = $this->di->get('database');
    }
    
    

    
    public function addPurchase($data){
    	//var_dump($data);
        //var_dump($data);
            try{
                
                for($i=0; $i< count($data['product_id']); $i++){
                    $this->database->beginTransaction();
                    $data_to_be_inserted = 
                    ['product_id'=> $data['product_id'][$i],
                      'supplier_id'=> $data['supplier_id'][$i],
                      'purchase_rate'=>$data['purchase_rate'][$i],
                      'quantity' => $data['quantity'][$i],
                      'created_at'=>Carbon\Carbon::now()->format('Y/m/d H:i:s'),
                      'deleted'=>0
                    ];
                    $purchase_id = $this->database->insert('purchase', $data_to_be_inserted);
                    $this->database->commit();
                    
                }
                return ADD_SUCCESS;
            }
            catch(Exception $e){
                // $this->database->rollback();
                // return ADD_ERROR;
            }

        }
        
    }