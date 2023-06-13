<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Customer;
use Validator;
use DB;
use Session;
use App\Cart;
use App\DataTables\ItemsDataTable;
use Auth;
use Pagination;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
use App\Rules\ItemExcelRule;
use App\Imports\ItemStockImport; 
use App\Imports\CustomerSheetImport; 
use App\Imports\CustomerItemSheetsImport;
use App\Events\OrderCreated;



class ItemController extends Controller
{
    public function index(ItemsDataTable $dataTable)
    {
        return $dataTable->render('items.index');
    }

    public function getItems(){
        // $items = Item::all();
        // $items = DB::table('item')->join('stock', 'item.item_id', '=', 'stock.item_id')->get();

        $items = Item::with('stock')->whereHas('stock')->paginate(3);
        return view('shop.index', compact('items'));
    }

    public function addToCart($id){
        // dd( $id);
        $item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        // dd($oldCart);
        $cart = new Cart($oldCart);
        // dd($cart);
        $cart->add($item, $item->item_id);
        // $request->session()->put('cart', $cart);
        // dd($cart);
        Session::put('cart', $cart);
        // dd(Session::get('cart'));
        // $request->session()->save();
        // Session::save();
        // dump( Session::all());
        return redirect()->route('getItems')->with('message','item added to cart');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping_cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        // dd($oldCart);
        return view('shop.shopping_cart', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getReduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->items) > 0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }        
        return redirect()->route('shoppingCart');
    }

    public function removeItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->route('shoppingCart');
    }

    public function postCheckout(Request $request){
        if (!Auth::check()) {
            return redirect()->route('user.signin');
        }
        
        if (!Session::has('cart')) {
            return redirect()->route('getItems');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // dd($cart);

        try {
            DB::beginTransaction();
            // $order = new Order();
            // dd(Auth::id());
            // dd($customer);
            // $customer->orders()->save($order);
            // $order->customer_id = $customer->customer_id;
            
            $customer =  Customer::where('user_id', Auth::id())->first();
            $order = new Order();
            $order->customer_id = $customer->customer_id;
            $order->date_placed = now();
            $order->date_shipped = now();
            // $order->shipvia = 1;
            $order->shipping = 10.00;
            $order->status = 'Processing';
            $order->save();
            // dd($order);

            foreach($cart->items as $items){
                $id = $items['item']['item_id'];
                // dd($id);
                DB::table('orderline')->insert(
                    ['item_id' => $id, 
                        'orderinfo_id' => $order->orderinfo_id,
                        'quantity' => $items['qty']
                    ]
                    );
                // $order->items()->attach($id,['quantity'=>$items['qty']]);
                $stock = Stock::find($id);
                $stock->quantity = $stock->quantity - $items['qty'];
                $stock->save();
            }
            // dd($order);
        }

        catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            // dd($order);
            return redirect()->route('shoppingCart')->with('error', $e->getMessage());
        }

        DB::commit();
        OrderCreated::dispatch($order, $customer, Auth::user()->email);
        Session::forget('cart');
        return redirect()->route('getItems')->with('success','Successfully Purchased Your Products!!!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'item_upload' => [
                'required',
                new ItemExcelRule($request->file('item_upload')),
            ],
        ]);

        // Excel::import(
        //     new ItemStockImport(),
        //     request()
        //         ->file('item_upload')
        //         ->store('temp')
        // );

        Excel::import(
            new ItemCustomerSheetImport(),
            request()
                ->file('item_upload')
                ->storeAs(
                    'files',
                    request()
                        ->file('item_upload')
                        ->getClientOriginalName()
                )
        );
        // Excel::import(new FirstSheetImport, request()->file('item_upload')->store('temp'));
        return redirect()
            ->back()
            ->with('success', 'Excel file Imported Successfully');
    }

}
