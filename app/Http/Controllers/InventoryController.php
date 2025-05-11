<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $items = Inventory::orderBy('id', 'desc')->get(); // Show newest item first

        // Loop to collect item names
        $names = [];
        foreach ($items as $item) {
            $names[] = $item->name; // Collecting item names into an array
        }

        // Subquery to get the average cost
        $averageCost = Inventory::selectRaw('AVG(item_cost) as avg_cost')->first();

        return view('inventory', compact('items', 'names', 'averageCost'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'item_cost' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);
    
        Inventory::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'item_cost' => $request->item_cost,
            'price' => $request->price,
        ]);
    
        return redirect()->back()->with('success', 'Item added successfully!');
    }

    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully!');
    }

    public function edit($id)
    {
        $item = Inventory::findOrFail($id);
        return view('edit-inventory', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'item_cost' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $item = Inventory::findOrFail($id);
        $item->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'item_cost' => $request->item_cost,
            'price' => $request->price,
        ]);

        return redirect()->route('inventory.index')->with('success', 'Item updated successfully!');
    }
}
