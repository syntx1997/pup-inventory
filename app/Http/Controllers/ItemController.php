<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Stock;

class ItemController extends Controller
{
    public function get_all($type) {
        $data = [];

        $items = Item::where('type', $type)->get();
        foreach ($items as $item) {

            $category = Category::where('id', $item->category_id)->first();
            $category_name = $category->name;

            $attribute =    ' data-id="'.$item->id.'" data-category_id="'.$item->category_id.'" data-name="'.$item->name.'""
                              data-description="'.$item->description.'" data-stock="'.$item->stock.'" data-critical="'.$item->critical.'"';

            $action =       '<button id="edit-btn" type="button" class="btn btn-link" '.$attribute.'><i class="uil-edit text-success"></i></button>'.
                            '<button id="delete-btn" type="button" class="btn btn-link" '.$attribute.'><i class="uil-trash text-danger"></i></button>';

            $stock_editable = '<button id="restock-btn" type="button" class="btn btn-link" '.$attribute.'>'.$item->stock.'</button>';
            $critical_editable = '<button id="critical-btn" type="button" class="btn btn-link" '.$attribute.'>'.$item->critical.'</button>';

            if($item->stock <= $item->critical) {
                $stock_status = '<span class="badge badge-danger-lighten p-2">Critical</span>';
            } else {
                $stock_status = '<span class="badge badge-success-lighten p-2">Safe</span>';
            }

            $stocks = [];
            $stocksData = Stock::find($item->id);
            if($stocksData !== null) {
                $stocks = $stocksData->get();
            }

            $data[] = [
                'id' => $item->id,
                'category_id' => $item->category_id,
                'category' => $category_name,
                'name' => $item->name,
                'stock' => $item->stock,
                'stock_editable' => $stock_editable,
                'critical' => $item->critical,
                'critical_editable' => $critical_editable,
                'description' => $item->description,
                'stocks' => $stocks,
                'stock_status' => $stock_status,
                'action' => $action
            ];
        }

        return response()->json(['data' => $data]);
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        Item::create($request->all());
        return response(['Item added successfully!'], 201);
    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $item = Item::find($request->id);
        $item->update($request->all());
        return response(['Item updated successfully!'], 201);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $item = Item::find($request->id);
        $item->delete();
        return response(['Item deleted successfully!'], 201);
    }

    public function restock(Request $request) {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'quantity' => 'required',
            'cost' => 'required',
            'supplier' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $item = Item::find($request->item_id);
        $item->update([
            'stock' => ($item->stock + $request->quantity)
        ]);

        Stock::create([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'cost' => $request->cost,
            'supplier' => $request->supplier
        ]);
        return response(['message' => 'Item has been restock successfully!'], 201);
    }

    public function set_critical(Request $request) {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'critical' => 'required|numeric|gt:0'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $item = Item::find($request->item_id);
        $item->update([
            'critical' => $request->critical
        ]);

        return response(['message' => 'Critical value successfully set.'], 201);
    }
}
