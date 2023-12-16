<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Http\Requests\StoreLineItemRequest;
use App\Http\Requests\UpdateLineItemRequest;

class LineItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $lineItems = LineItem::orderBy('id', 'DESC')->get();
		
        return view('lineItem.index', compact('lineItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		return view('lineItem.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLineItemRequest $request)
    {
        $lineItem = LineItem::create([
            'name'        => $request->name,
            'description' => $request->description,
            'unit_price'  => $request->unit_price,
			'quantity'    => $request->quantity,
        ]);

        return redirect(route('lineItem.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(LineItem $lineItem)
    {
        return view('lineItem.show', compact('lineItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LineItem $lineItem)
    {
        return view('lineItem.edit', compact('lineItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLineItemRequest $request, LineItem $lineItem)
    {
        $lineItem->update($request->validated());
		return redirect(route('lineItem.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LineItem $lineItem)
    {
        $lineItem->delete();
        return redirect(route('lineItem.index'));
    }
}
