<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Request as RequestModel;
use App\Models\User;
use App\Models\Item;


class RequestController extends Controller
{
    public function add(Request $request) {
        if(! $request->item) {
            return response(['message' => 'You dont select any items to request.'], 401);
        }

        $transaction = Transaction::create([
            'transaction_id' => 'TRNSCTN'.date('ymdhis'),
            'user_id' => $request->user_id
        ]);

        $id = $transaction->id;
        $items = $request->item;
        foreach ($items as $item) {
            RequestModel::create([
                'transaction_id' => $id,
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity']
            ]);
        }

        return response(['message' => 'Request has been submitted!', 'items' => $items, 'request'=> $request->all()], 201);
    }

    public function get_all($user_id) {
        $data = [];

        $transactions = Transaction::where('user_id', $user_id)->get();
        foreach ($transactions as $transaction) {
            $items = [];
            $user = User::where('id', $transaction->user_id)->first();

            $requests = RequestModel::where('transaction_id', $transaction->id)->get();
            foreach ($requests as $request) {
                $selectedItem = Item::where('id', $request->item_id)->first();
                $items[] = [
                    'id' => $request->id,
                    'item_id' => $selectedItem->id,
                    'name' => $selectedItem->name,
                    'description' => $selectedItem->description,
                    'quantity' => $request->quantity
                ];
            }

            $data[] = [
                'id' => $transaction->id,
                'transaction_id' => $transaction->transaction_id,
                'name' => $user->name,
                'designation' => $user->designation,
                'office' => $user->office,
                'items' => $items,
                'items_html' => '',
                'status' => $transaction->status,
                'message' => $transaction->message
            ];
        }

        return response()->json(['data' => $data]);
    }
}
