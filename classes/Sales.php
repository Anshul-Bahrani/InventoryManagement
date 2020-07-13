<?php
use Carbon\Carbon;

class Sales {
    private $table = "products";
    private $database;
    protected $di;
    
    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
        $this->database = $this->di->get('database');
    }
    public function validateData($data) {
        $myarr =  [
            'customer_id' => [
                'required' => true,
                'number' => true
            ]
            ];
        // $id = 1;
        // $temp = ['required' => true];
        // foreach($data['product_id'] as $prod) {
        //     $myarr["product_id[{$id}]"] = $temp;
        //     echo $data['product_id[0]'];
        //     $id ++;
        // }
        // $this->di->get('util')->dd($myarr);
        return $this->di->get('validator')->check($data, $myarr);
    }
    public function addSales($data) {
        $validation = $this->validateData($data);
        if(!$validation->fails()) {
            $this->di->get('database')->beginTransaction();
            $customer_id = $data['customer_id'];
            $invoicedata = [
                'customer_id' => $customer_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted' => 0
            ];

            $invoice_id = $this->di->get('database')->insert('invoice', $invoicedata);
            // $this->di->get('util')->dd($invoice_id);
            $this->di->get('product')->insertForInvoice($invoice_id, $data['product_id'], $data['quantity'], $data['discount']);
            $this->insertPaymentDetails($invoice_id, $data);
            $this->di->get('database')->commit();
            return $this->getInvoiceData($invoice_id);
        }
        else {
            // $this->di->get('util')->dd("ffff");
            return VALIDATION_ERROR;
        }
    }
    public function insertPaymentDetails($invoice_id, $data) {
        $ways = ['cheque', 'google_pay', 'paypal', 'cash'];
        $way = $data['payment_method'];

        $id = $this->database->insert('payments', [
                'invoice_id' => $invoice_id,
                'payment_mode' => $ways[$way - 1]
            ]);
        if(intval($way) == 1) {
            $cheque_id = $this->database->insert('cheque_details', [
                'payment_id' => $id,
                'cheque_no' => $data['cheque_no'],
                'cheque_date' => $data['cheque_date'],
                'bank_name' => $data['bank_name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted' => 0
            ]);
        }
        
    }
    public function getInvoiceData($id) {
        $sql = "SELECT invoice.id,product_selling_rates.selling_rate , product_selling_rates.product_id,product_selling_rates.selling_rate , sales.quantity, sales.discount, ((product_selling_rates.selling_rate)*(sales.quantity) - (product_selling_rates.selling_rate)*(sales.quantity)*((sales.discount)/100)) as rate, products.name, category.name as category, products.hsn_code, payments.payment_mode, payments.id as payment_id, invoice.customer_id, invoice.created_at
        FROM invoice, product_selling_rates, sales, products, category, payments, cheque_details
        WHERE invoice.id = {$id} and invoice.id = sales.invoice_id and sales.product_id = product_selling_rates.product_id and product_selling_rates.with_effect_from <= DATE(invoice.created_at) and sales.product_id = products.id and products.category_id = category.id and invoice.id = payments.invoice_id
        GROUP BY sales.product_id 
        HAVING MIN(DATE(invoice.created_at) - product_selling_rates.with_effect_from)";
        return $this->database->raw($sql);
    }
    public function getChequeDetails($id) {
        return $this->database->readData('cheque_details', ['cheque_no', 'cheque_date', 'bank_name'], "payment_id = {$id} and deleted = 0");
    }

    public function getAllInvoices() {
        $sql = "SELECT invoice.id, customers.first_name, customers.last_name, invoice.created_at
        FROM invoice, customers
        WHERE invoice.customer_id = customers.id and invoice.deleted = 0 
        ORDER BY invoice.created_at desc";
        $invoices =  $this->database->raw($sql);
        // $this->di->get('util')->dd($invoices);
        // $this->di->get('util')->dd(Carbon::now());
        foreach($invoices as $invoice) {
            $invoice->date = Carbon::parse($invoice->created_at)->diffForHumans();
        }
        return $invoices;
    }
}

?>