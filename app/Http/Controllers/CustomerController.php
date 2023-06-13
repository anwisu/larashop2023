<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Item;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $customer = Customer::find(3);
        // dump($customer->orders);
        // foreach ($customer->orders as $order) {

        //     dump($order->orderinfo_id, $order->date_placed);
        // }

        // $order = Order::find(3);
        // $items = Item::find(4);
        // dump($items->orders);
        // foreach ($items->orders as $order) {

        //     dump($order->orderinfo_id,$order->date_placed);
        // }
        // foreach ($order->items as $items) {

        //     dump($items->title,$items->sell_price);
        // }

        

        // dd($customer->orders);
        
//WEEK 2
        // $customer = Customer::find(16);
        // dump($customer->user->email);

        // $order = Order::find(1);
        // dump($order->items);
        // foreach ($order->items as $item) {

        //     dump($item->title,$item->sell_price, $item->pivot->quantity);
        // }

//LAZY LOADING
        // $customers = Customer::all();
        // dump($customers);
        // foreach ($customers as $customer) {

        //     dump($customer->orders);
        //     foreach ($customer->orders as $order) {
        //         dump($order->orderinfo_id, $order->date_placed);
        //     }
        // }

//EAGER LOADING
    //EAGER LOADING - CUSTOMER
        // $customers = Customer::with('orders')->get();
        // dump($customers);
        // foreach($customers as $customer) {
        //     dump($customer->lname, $customer->addressline);

        //     foreach($customer->orders as $order) {
        //         dump($order->orderinfo_id, $order->date_placed);
        //     }
        // }

    //EAGER LOADING - ORDERS with CONSTRAINT
        // $orders = Order::with('customer')->where('orderinfo_id', 3)->get();
        // dump($orders);
        // foreach($orders as $order) {
        //     dump($order->orderinfo_id, $order->date_placed, $order->customer->lname, $order->customer->addressline);
        // }

    //EAGER LOADING with SPECIFIC COLUMN
        // $customer = Customer::with('user:id,email,role')->where('customer_id', 17)->first();
        // dump($customer->user->role, $customer->user->email);

        $orders = Order::with(['customer','items'])->get();
        dump($orders);
        foreach($orders as $order) {
            dump($order->customer->lname, $order->customer->addressline, $order->orderinfo_id, $order->date_shipped, $order->shipping);

            foreach($order->items as $item) {
                dump($item->item_id, $item->title, $item->sell_price, $item->pivot->quantity);
            }
        }

        // $items = Item::with('orders')->where('item_id', 4)->get();
        // dump($items);
        // foreach($items as $item) {
        //     dump($item->title, $item->sell_price);  
        //     foreach($item->orders as $order) {
        //         dump($order->orderinfo_id, $order->shipping);
        //     }
        // }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
