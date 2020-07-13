<?php
require_once __DIR__ . '/../../helper/init.php';
if(isset($_GET['id'])) {
	
	$id = $_GET['id'];
	$res = $di->get('sales')->getInvoiceData($id);
	$di->get('util')->dd($res);
	if(count($res) == 0) {
		$di->get('util')->redirect('add-sales.php');
	}
	if ($res[0]->payment_mode == 'cheque') {
		$che = $di->get('sales')->getChequeDetails($res[0]->payment_id);
		$res[0]->cheque_no = $che[0]->cheque_no;
		$res[0]->cheque_date = $che[0]->cheque_date;
		$res[0]->bank_name = $che[0]->bank_name;
	}
	$tofill = $res[0];
	$customer_details = $di->get('customer')->getDetailsByID($tofill->customer_id)[0];
	// $di->get('util')->dd($res);
}
else {
	$di->get('util')->redirect('add-sales.php');
}

?>
<html>
    <head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # <?= $tofill->id?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					<?= $customer_details->first_name ?>
    					<?= $customer_details->last_name ?><br>
						<?= $customer_details->block_no?>, <?=$customer_details->street ?>, <?= $customer_details->pincode?><br>
						<?= $customer_details->city?>, <?=$customer_details->state ?>, <?= $customer_details->country?>
						<br>
						<!-- Springfield, ST 54321 -->
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Contact:</strong><br>
    					<?= $customer_details->phone?><br>
    					<?= $customer_details->email?><br>
    					
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<?=$tofill->payment_mode?><br>
						<?php
						if($tofill->payment_mode == "cheque") {
							echo "Cheque Details: <br> Cheque No:";
							echo $tofill->cheque_no;
							echo "  Cheque Date: ";
							$newdate = date("d, F Y", strtotime($tofill->cheque_date));
							echo $newdate;
							echo "<br>Bank:";
							echo $tofill->bank_name;
						}
						?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
						<strong>Order Date:</strong><br>
						<?php
						$neworderdate = date("d, F Y", strtotime($tofill->created_at));
						?>
    					<?=$neworderdate?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price(&#8377)</strong></td>
									<td class="text-center"><strong>Quantity</strong></td>
									<td class="text-center"><strong>Discount(%)</strong></td>
        							<td class="text-right"><strong>Totals(&#8377)</strong></td>
                                </tr>
    						</thead>
    						<tbody>
								<!-- foreach ($order->lineItems as $line) or some such thing here -->
								<?php 
								$total = 0.0;
								foreach($res as $item):
								?>
    							<tr>
    								<td><?= $item->name?></td>
    								<td class="text-center"><?= $item->selling_price?></td>
									<td class="text-center"><?= $item->quantity?></td>
									<td class="text-center"><?= $item->discount?></td>
									<td class="text-right"><?= $item->rate?></td>
									<?php 
									$total = $total + $item->rate;
									?>
								</tr>
								<?php
								endforeach;
								?>
                                <!-- <tr>
        							<td>BS-400</td>
    								<td class="text-center">$20.00</td>
    								<td class="text-center">3</td>
    								<td class="text-right">$60.00</td>
    							</tr>
                                <tr>
            						<td>BS-1000</td>
    								<td class="text-center">$600.00</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$600.00</td>
    							</tr> -->
    							<!-- <tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$670.99</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$15</td>
    							</tr> -->
    							<tr>
    								<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">&#8377 <?= $total?></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
</body>
</html>