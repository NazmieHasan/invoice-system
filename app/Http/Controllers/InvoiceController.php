<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\Invoice;
use App\Models\User;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
		$invoices = Invoice::orderBy('id', 'DESC')->get();
		
        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$lineItems = LineItem::orderBy('name')->get();
		
		return view('invoice.create', compact('lineItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
		$invoiceNumber = rand(10, 1000);
		
		$this->storeOrUpdate($request, $invoice);
		
        $invoice = Invoice::create([
		    'invoice_number'     => $invoiceNumber,
            'customer_name'      => $request->customer_name,
			'customer_email'     => $request->customer_email,
			// id:quantity;id:quantity;id;id:quantity    
            'line_items_and_qty' => $lineItemsAndQtyToDb, 
			'user_id'            => auth()->id(),
			'total_amount'       => $totalAmount,
        ]);

        return redirect(route('invoice.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
		$id = $invoice['id']; 
		$lineItemsAndQtyFromDb = Invoice::where('id', $id)->first(['line_items_and_qty'])->line_items_and_qty;
		$lineItemsAndQtyFromDbExplode = explode(';', $lineItemsAndQtyFromDb); 
		$sum = 0;
		$totalAmount = 0;
		
		foreach ($lineItemsAndQtyFromDbExplode as $lineItemsAndQtyFromDb) {
			$lineItemAndQuantity = explode(':', $lineItemsAndQtyFromDb); 
			
			$lineItemId = $lineItemAndQuantity[0]; 
			$lineItem = LineItem::where('id', $lineItemId)->first(['unit_price'])->unit_price;
			$lineItemToDecimal = (number_format($lineItem, 2));
			$qty = (int)$lineItemAndQuantity[1]; 
			
			$sum = $lineItem * $qty; 
			$totalAmount += $sum;
			//var_dump("$lineItemToDecimal * $qty = "); 
			//var_dump(number_format($sum, 2)); 
			//echo "<br />";
		}
		//var_dump("Total sum is: $totalAmount"); 
		
        return view('invoice.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
		$id = $invoice['id']; 
		$lineItemsAndQtyFromDb = Invoice::where('id', $id)->first(['line_items_and_qty'])->line_items_and_qty;
		$lineItemsAndQtyFromDbExplode = explode(';', $lineItemsAndQtyFromDb); 
		$lineItemWithCheckboxCkecked;
		
		foreach ($lineItemsAndQtyFromDbExplode as $lineItemsAndQtyFromDb) {
			$lineItemAndQuantity = explode(':', $lineItemsAndQtyFromDb); 
			$lineItemId = $lineItemAndQuantity[0]; 
			$lineItemWithCheckboxCkecked = LineItem::where('id', $lineItemId)->get();
		}
		
		$lineItems = LineItem::orderBy('name')->get();
		
        return view('invoice.edit', compact('invoice', 'lineItems', 'lineItemWithCheckboxCkecked'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
		$this->storeOrUpdate($request, $invoice);
        $invoice->update($request->validated());
		return redirect(route('invoice.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect(route('invoice.index'));
    }
	
	protected function storeOrUpdate($request, $invoice)
    {
        // line item id
		$lineItemCheckboxArr = $request->input('line_items'); 
		
		$arr = [];
		foreach ($lineItemCheckboxArr as $key => $lineItemId) {
			$arr[] = $lineItemId; 
		}
		
		// line item default quantity = 1
		// TODO quantity > 1
		$lineItemQuantity = 1;
		$lineItemsAndQtyToDb = "";
	    $oneLineItemAndQty = implode(':1;', $arr); 
	    $lineItemsAndQtyToDb .= $oneLineItemAndQty;
		$lineItemsAndQtyToDb .= ":1";

		$qty = (int)$lineItemQuantity;
		$sum = 0;
		$totalAmount = 0;
		
		foreach ($lineItemCheckboxArr as $key => $lineItemId) {
			$lineItem = LineItem::where('id', $lineItemId)->first(['unit_price'])->unit_price;
			$lineItemToDecimal = (number_format($lineItem, 2));
			$sum = $lineItem * $qty; 
			$totalAmount += $sum;
		}
		
		$invoice['line_items_and_qty'] = $lineItemsAndQtyToDb;
		$invoice['total_amount'] = $totalAmount;
    }
}
