<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Request as RequestModel;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;


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

    public function all() {
        $data = [];

        $transactions = Transaction::all();
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

            $attribute = <<<HERE
                data-id="$transaction->id"
            HERE;

            $actions = <<<HERE
                <buttton id="accept-btn" type="button" class="btn btn-link text-success" $attribute><i class="uil-thumbs-up"></i> Accept</button>
                <buttton id="decline-btn" type="button" class="btn btn-link text-danger" $attribute><i class="uil-thumbs-down"></i> Decline</button>
            HERE;

            $data[] = [
                'id' => $transaction->id,
                'transaction_id' => $transaction->transaction_id,
                'name' => $user->name,
                'designation' => $user->designation,
                'office' => $user->office,
                'items' => $items,
                'items_html' => '',
                'status' => $transaction->status,
                'message' => $transaction->message,
                'actions' => $actions
            ];
        }

        return response()->json(['data' => $data]);
    }

    public function accept(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 491);
        }

        $transaction = Transaction::find($request->id);
        $transaction->update([
            'status' => 'Accepted',
            'message' => $request->message
        ]);

        return response(['message' => 'Employee request has been accepted.']);
    }

    public function decline(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 491);
        }

        $transaction = Transaction::find($request->id);
        $transaction->update([
            'status' => 'Desclined',
            'message' => $request->message
        ]);

        return response(['message' => 'Employee request has been declined.']);
    }
}
