<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Models\TransactionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    //
    public  function  index()
    {


        // Destroy the 'void_mode' session variable
        $cart = CartModel::with('item')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();


        return view('employee.home', compact('cart'));


    }
    public  function  receipt($id){

        $trans= TransactionModel::with('orders.item' ,'user')->where('id',$id)->first();

        return view('employee.receipt' ,compact('trans'));
    }

    public  function  void(){
        return view('employee.void');
    }

    public  function  report(){

         $trans= TransactionModel::with('orders.item' ,'user')->where('user_id',Auth::id())->get();

        return view('employee.report',compact('trans'));
    }

    public  function  searchProductByNameOrID(Request $request){

        $searchTerm = $request->input('term');

       return    $items = ItemModel::where('id', 'like', '%' . $searchTerm . '%')

            ->orWhere('name', 'like', '%' . $searchTerm . '%')
            ->Where('status','Active')
            ->get();
    }

    public  function   addItem (Request $request){

        $id = $request->input('id');


        return  ItemModel::where('id',$id)->first();

    }


    public function addCart(Request $request)
    {


        $user = Auth::user();
        $item = ItemModel::find($request->id);

        if (!$user || !$item) {
            return response()->json(['error' => 'User or Item not found'], 404);
        }

        $amount =  $item->selling_price;

        // Check if the item already exists in the user's cart
        $existingCart = CartModel::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->first();


      //  dd( $item->no_of_stocks);

        if ($existingCart) {

            $item_quantity =  $existingCart->quantity;
            $cart_quantity =  $item_quantity  + 1  ;

            if ( $cart_quantity  > $item->no_of_stocks ) {


                return response()->json(['success' => false , 'message' => 'No more stocks'], 201);
            }
//            dd($cart_quantity . '-' . $item->no_of_stocks);
        }




        if ($existingCart) {

            // If the item exists, increment the quantity
            $existingCart->quantity += 1;
            $existingCart->save();

            $all =  CartModel::with('item')->where('user_id',Auth::id())->get();

            return response()->json(['data' => $all], 201);
        }


        if (  $item->no_of_stocks  == 0 ) {
            return response()->json(['success' => false , 'message' => 'No more stocks'], 201);
        }


        // If the item does not exist in the cart, create a new cart entry
        $cart = new CartModel([
            'amount' =>  $amount,
            'quantity' => 1,
            // Add any other fields you need for your cart
        ]);

        // Associate the user and item with the cart
        $cart->user()->associate($user);
        $cart->item()->associate($item);

        $cart->save();
        $all =  CartModel::with('item')->where('user_id',Auth::id())->get();

        return response()->json(['data' => $all], 201);

    }


    public function getTotalofCart(){


        return  $totalAmount = CartModel::where('user_id', Auth::id())
            ->selectRaw('SUM(amount * quantity) as total_amount')
            ->value('total_amount');
    }

    public  function  changeQuantity(Request $request){

        $id = $request->input('id');
        $new_quantity = $request->input('new_quantity');


        $cartItem = CartModel::find($id);



        //check if item has enough stocks

        $item = ItemModel::find($cartItem->item_id);

        if ($new_quantity  > $item->no_of_stocks) {
            return response()->json(['success' => false , 'message' => 'Stock is only '. $item->no_of_stocks ,'stock' =>  $item->no_of_stocks ], 201);
        }

        //

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Update the quantity field
        $cartItem->update(['quantity' => $new_quantity]);

        $new_amount =   number_format($new_quantity * $cartItem->amount, 2) ;


        $totalAmount = $this->getTotalofCart();

        $data =  $cartItem = CartModel::with('item')->where('id',$id)->first();

        return response()->json(['data' => $data,'response'=>$new_amount , 'new_total_amount' => $totalAmount ,'success' => true], 200);




    }

    public  function  voidItem(Request $request){




        $id = $request->input('id');

        // Find the cart item by ID
        $cartItem = CartModel::find($id);

        // Check if the cart item exists
        if ($cartItem) {
            // Delete the cart item
            $cartItem->delete();

            // Optionally, you can return a response or perform additional actions
            return response()->json(['success' => true, 'message' => 'Cart item deleted successfully']);
        }

        // If the cart item doesn't exist, return a response or perform other actions
        return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);





    }

    public function verifyCredentials(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Check the credentials against your user table
        $user = DB::table('users')->where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            // If the credentials are valid, set the session variable
            Session::put('void_mode', true);

            return response()->json(['success' => true, 'message' => 'Credentials verified']);

        }
        return response()->json(['success' => false, 'message' => 'Invalid Username or Password'] );


    }

    public  function  voidDone(){
        Session::forget('void_mode');

        return redirect('/employee/');

    }

    public  function  payNow(Request $request){


        $transaction = new TransactionModel([
            'user_id' => Auth::id(),
            'total_amount' => $request->input('total_amount'),
            'total_profit' =>  1,
            'discount' => $request->input('discount') * 0.01,
            'total_amount_with_discount' => $request->input('total_amount_with_discount'),
            'updated_at' => now(),
            'created_at' => now(),
            'amount_received' =>$request->input('amount_received'),
            'change' =>$request->input('change'),
        ]);
        $transaction->save();

        $transaction_id = $transaction->id;

        $carts = CartModel::where('user_id',Auth::id())->get();


        $total_profit = 0;

        foreach ($carts as $cart){

            $supplier_price =  ItemModel::where('id',  $cart->item_id)->value('supplier_price');
            $selling_price =  ItemModel::where('id',  $cart->item_id)->value('selling_price');
            $profit = ( $supplier_price - $selling_price ) * $cart->quantity;

            $total_profit+=$profit;

            $order = new OrderModel([
                'transaction_id' => $transaction_id,
                'item_id' => $cart->item_id,
                'quantity' => $cart->quantity,
                'amount' => $cart->amount,
                'profit' => $profit
            ]);
            $order->save();

            $item = ItemModel::find($cart->item_id);

            if ($item->no_of_stocks >= $cart->quantity ) {
                $item->decrement('no_of_stocks', $cart->quantity );
            }



        }


        $transaction = TransactionModel::find($transaction_id);
        $transaction->update(['total_profit' => $total_profit]);


         CartModel::where('user_id', Auth::id())->delete();



        // Check if there are sufficient stocks



        return response()->json(['success' => true, 'message' => 'Payment successfull' , 'id'=> $transaction_id]);


    }
}
