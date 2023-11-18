<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Models\BatchModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\SupplierModel;
use App\Models\BatchOrderModel;
use App\Models\ReturnGroundsModel;
use App\Models\ReturnItemModel;
use App\Models\TransactionModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public  function  index()
    {
        $categories = CategoryModel::all();
        return view('admin.admin', ['categories'=> $categories]);
    }


    /*
    |--------------------------------------------------------------------------
    | CATEGORY FUNCTION
    |--------------------------------------------------------------------------
    */


    /**
     * Show Category 
     */
    public  function  item_category()
    {
        $categories = CategoryModel::all();
        return view('admin.item-category', ['categories'=> $categories]);
    }

    /**
     * Create New Category
     */
    public function storeCategory(Request $request)
    {
       $data = $request->validate([
            'category_name' => 'required|unique:category,category_name'
       ]);

        CategoryModel::create($data);

        return redirect()->back()->with('success', 'Name added successfully');
    }

    /**
     * Update Category Status
     */
    public function CategoryStatus(Request $request)
    {
        $categoryId = $request->input('id');
        $newStatus = $request->input('new_status');

        // Find the category by its ID
        $category = CategoryModel::find($categoryId);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Update the category status
        $category->status = $newStatus;
        $category->save();

        return redirect()->back()->with('success', 'Category status updated successfully.');
    }

    /**
     * Update Category Name
     */
    public function updateCategory(Request $request)
    {
        $category_id = $request->input('id');
        $new_category_name = $request->input('category_name');
    
        // Check if the category name already exists, excluding the current category.
        $existingCategory = CategoryModel::where('category_name', $new_category_name)
            ->where('id', '!=', $category_id)
            ->first();
    
        if ($existingCategory) {
            return redirect()->back()->with('error', 'Category already exists.');
        }
            // Update the category name if it doesn't already exist.
        $category = CategoryModel::find($category_id);
        $category->category_name = $new_category_name;
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | SUPPLIER FUNCTION
    |--------------------------------------------------------------------------
    */

    /**
     * Show Supplier
     */
    public  function  supplier()
    {
        $suppliers = SupplierModel::all();
        return view('admin.supplier', ['suppliers'=> $suppliers]);
    }

    /**
     * Create New Supplier
     */
    public function storeSupplier(Request $request)
    {
       $data = $request->validate([
            'supplier_name' => 'required|unique:supplier,supplier_name',
            'email' => 'required|unique:supplier,email',
            'contact_no' => 'required|unique:supplier,contact_no',
       ]);

       if (!preg_match('/^09\d{9}$/', $request->input('contact_no'))) {
        return redirect()->back()->with('error', 'Invalid contact number format. It should start with 09 and have 11 digits.');
    }

        SupplierModel::create($data);

        return redirect()->back()->with('success', 'Supplier Name added successfully');
    }

    /**
     * Update Supplier Status
     */
    public function SupplierStatus(Request $request)
    {
        $supplierId = $request->input('id');
        $newStatus = $request->input('new_status');

        // Find the category by its ID
        $supplier = SupplierModel::find($supplierId);

        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier not found.');
        }

        // Update the category status
        $supplier->status = $newStatus;
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier status updated successfully.');
    }

    /**
     * Update Supplier Name
     */
    public function updateSupplier(Request $request)
    {
        // Validate request data
        $request->validate([
            'supplier_name' => 'required|string',
            'email' => 'required|email',
            'contact_no' => 'required|string',
        ]);

        // Check if the category with the provided details already exists
        $existingSupplier = SupplierModel::where('supplier_name', $request->input('supplier_name'))
            ->where('email', $request->input('email'))
            ->where('contact_no', $request->input('contact_no'))
            ->first();

        if ($existingSupplier) {
            return redirect()->back()->with('error', 'Supplier Name already exists.');
        }

        if (!preg_match('/^09\d{9}$/', $request->input('contact_no'))) {
            return redirect()->back()->with('error', 'Invalid contact number format. It should start with 09 and have 11 digits.');
        }
        
        // Update the category name if it doesn't already exist.
        $supplier = SupplierModel::find($request->input('id'));
        $supplier->supplier_name = $request->input('supplier_name');
        $supplier->email = $request->input('email');
        $supplier->contact_no = $request->input('contact_no');
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | STOCKS FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Show stocks data
     */
    public  function  stocks(Request $request)
    {
        $categories = CategoryModel::where('status', 'Active')->get();
        $suppliers = SupplierModel::where('status', 'Active')->get();
        DB::statement("SET SQL_MODE=''");
        $ItemStocks = ItemModel::where('status', 'Active')->groupby('name')->get();
        $items = ItemModel::with('category', 'supplier')->get();

        $lastBatch = BatchModel::latest('id')->first();
        $lastId = $lastBatch ? $lastBatch->id + 1 : 1;

        return view('admin.stocks', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'items' => $items,
            'ItemStocks' => $ItemStocks,
            'lastId' => $lastId,
        ]);
    }

    public function getItems(Request $request)
    {
        $category_id = $request->input('category_id');
        $supplier_id = $request->input('supplier_id');

        $items = ItemModel::when($category_id, function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        })->when($supplier_id, function ($query) use ($supplier_id) {
            $query->where('supplier_id', $supplier_id);
        })->when($category_id && $supplier_id, function ($query) use ($category_id, $supplier_id) {
        $query->where('no_of_stocks', '=', DB::raw('replenish'));
    })->get();

        return response()->json($items);
    }
    
    /**
     * Create New Items 
     */
    public function storeStocks(Request $request)
    {
        $request->validate([
            'name.*' => 'required|string',
            'supplier_price.*' => 'required|numeric',
            'selling_price.*' => 'required|numeric',
            'no_of_stocks.*' => 'required|numeric',
            'replenish.*' => 'required|numeric',
            'category_id.*' => 'required|exists:category,id',
            'supplier_id.*' => 'required|exists:supplier,id',
        ]);

        $data = $request->only(['name', 'supplier_price', 'selling_price', 'no_of_stocks', 'replenish', 'category_id', 'supplier_id']);

        // Initialize an array to store batch order data
        $batchOrderData = [];

        // Insert into the Item table and prepare batch order data
        foreach ($data['name'] as $key => $item) {

            // Check if the item already exists
            $existingItem = ItemModel::where('name', $item)
                ->where('supplier_id', $data['supplier_id'][$key])
                ->where('category_id', $data['category_id'][$key])
                ->first();

            if ($existingItem) {
                return redirect()->back()->with('error', 'Item details already exists.');
            }

            $itemModel = ItemModel::create([
                'name' => $item,
                'supplier_price' => $data['supplier_price'][$key],
                'selling_price' => $data['selling_price'][$key],
                'no_of_stocks' => $data['no_of_stocks'][$key],
                'replenish' => $data['replenish'][$key],
                'category_id' => $data['category_id'][$key],
                'supplier_id' => $data['supplier_id'][$key],
            ]);

            // Prepare data for batch_order
            $batchOrderData[] = [
                'batch_id' => null, // Will be updated after creating the BatchModel
                'item_id' => $itemModel->id,
                'supplier_id' => $data['supplier_id'][$key],
                'category_id' => $data['category_id'][$key],
                'replenish' => $data['replenish'][$key],
                'qty' => $data['no_of_stocks'][$key],
                'supplier_price' => $data['supplier_price'][$key],
                'total' => $data['no_of_stocks'][$key] *  $data['supplier_price'][$key],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
        }

        // Insert into the batch table
        $user = Auth::id();
        $batch = BatchModel::create([
            'user_id' => $user,
        ]);

        // Update batch_id in batch_order data and insert into batch_order table
        foreach ($batchOrderData as &$orderData) {
            $orderData['batch_id'] = $batch->id;
        }

        BatchOrderModel::insert($batchOrderData);

        return redirect()->back()->with('success', 'Items inserted successfully.');
    }
 

    /**
     * Restock Item
     */
    public function storeRestock(Request $request)
    { 
        
        // Validation
        $validatedData = $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'id' => 'required',
            'qty' => 'required|numeric',
        ]);

        // Find the item
        $item = ItemModel::find($request->input('id'));

        // Check for an existing transaction with similar input
        $existingTransaction = BatchOrderModel::where([
            'category_id' => $validatedData['category_id'],
            'supplier_id' => $validatedData['supplier_id'],
            'item_id' => $validatedData['id'],
            'qty' => $validatedData['qty'],
        ])->exists();

        if ($existingTransaction) {
            return redirect()->back()->with('error', 'Item already exists in a transaction.');
        }

        // Start a database transaction
        DB::beginTransaction();

        try {    
            // Insert into the batch_order table
            $batchOrder = BatchOrderModel::create([
                'batch_id' => null,
                'category_id' => $validatedData['category_id'],
                'supplier_id' => $validatedData['supplier_id'],
                'item_id' => $validatedData['id'],
                'supplier_price' => $item->supplier_price,
                'replenish' =>  $item->replenish,
                'qty' => $validatedData['qty'],
                'total' => $item->supplier_price * $validatedData['qty'],
            ]);

            // Update the no_of_stocks in the ItemModel table
            $remainingStocks = $item->no_of_stocks + $validatedData['qty'];
            $item->update(['no_of_stocks' => $remainingStocks]);

            // Insert into the batch table
            $user = Auth::id();
            $batch = BatchModel::create([
                'user_id' => $user,
            ]);
            
            // Update batch_id in batch_order table
            $batchOrder->update(['batch_id' => $batch->id]);

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Items Restocked Successfully.');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();

            // Log the error
            error_log('Error inserting into batch_order: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error Restocking Items. Please try again.');
        }
    }

    /**
     * Update Stock Status
     */
    public function StockStatus(Request $request)
    {
        $itemId = $request->input('id');
        $newStatus = $request->input('new_status');

        // Find the category by its ID
        $supplier = ItemModel::find($itemId);

        if (!$supplier) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        // Update the category status
        $supplier->status = $newStatus;
        $supplier->save();

        return redirect()->back()->with('success', 'Item status updated successfully.');
    }

    /**
     * Update Stock details
     */
    public function updateStocks(Request $request)
    {
        $itemId = $request->input('id');

        // Validate that required fields are not empty
        if (empty($request->input('name')) ||
        empty($request->input('supplier_price')) ||
        empty($request->input('selling_price')) ||
        empty($request->input('category_id')) ||
        empty($request->input('supplier_id')) ||
        empty($request->input('replenish'))
        ) {
        return redirect()->back()->with('error', 'All fields are required');
        }

        $existingItemname = ItemModel::where('name', $request->input('name'))
        ->where('id', '<>', $itemId)
        ->first();

        if ($existingItemname) {
            // If the item name already exists for a different item, return an error
            return redirect()->back()->with('error', 'Item name already exists for another item');
        }
        
        // Update the Item table
        $item = ItemModel::find($itemId);
        $item->name = $request->input('name');
        $item->supplier_price = $request->input('supplier_price');
        $item->selling_price = $request->input('selling_price');
        $item->category_id = $request->input('category_id'); 
        $item->supplier_id = $request->input('supplier_id'); 
        $item->replenish = $request->input('replenish'); 
        $item->save();

        // Update the Batch Order table if needed
        $batch = BatchOrderModel::where('item_id', $itemId)->first();
       
        if ($batch) {
            $batch->update([
                'category_id' => $request->input('category_id'),
                'supplier_id' => $request->input('supplier_id'),
                'supplier_price' => $request->input('supplier_price'),
                'selling_price' => $request->input('selling_price'),
                'replenish' => $request->input('replenish'),
                'total' =>  $batch->qty * $request->input('supplier_price'),
            ]);
        }

        return redirect()->back()->with('success', 'Item updated successfully');
    }


    /*
    |--------------------------------------------------------------------------
    | RETURN ITEM FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Show stocks data
     */
    public  function  return()
    {
        $categories = CategoryModel::where('status', 'Active')->get();
        $suppliers = SupplierModel::where('status', 'Active')->get();
        $ItemStocks = ItemModel::where('status', 'Active')->get();
        $users = User::where('user_role', '3')->get();
        $grounds = ReturnGroundsModel::all();
        $return_items = ReturnItemModel::with('item','user')
        ->where('status', 'Active')
        ->get();

        return view('admin.return', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'users' => $users,
            'ItemStocks' => $ItemStocks,
            'grounds' => $grounds,
            'return_items' => $return_items,
        ]);
    }

    /**
     * Store return item
     */
    public function addReturn(Request $request)
    {
            // Validate that required fields are not empty
            if (empty($request->input('transaction_id')) ||
            empty($request->input('purchased_date')) ||
            empty($request->input('return_date')) ||
            empty($request->input('ground_id')) ||
            empty($request->input('item_id')) ||
            empty($request->input('user_id'))
            ) {
            return redirect()->back()->with('error', 'All fields are required');
            }


        // Validate the form data
        $request->validate([
            'transaction_id' => 'required',
            'purchased_date' => 'required|date',
            'return_date' => 'required|date',
            'ground_id' => 'required',
            'item_id' => 'required',
            'user_id' => 'required',
        ]);

        // Check if the transaction ID exists in the transaction table
        // $transactionExists = TransactionModel::where('id', $request->input('transaction_id'))->exists();

        // if (!$transactionExists) {
        //     // If the transaction ID doesn't exist, return an error message
        //     return redirect()->back()->with('error', 'Transaction ID does not exist');
        // }

        // Create a new instance of the Return model
        $return = new ReturnItemModel;

        // Set the values from the form
        $return->transaction_id = $request->input('transaction_id');
        $return->purchase_date = $request->input('purchased_date');
        $return->return_date = $request->input('return_date');
        $return->return_ground = $request->input('ground_id');
        // $return->category_id = $request->input('category_id');
        $return->item_id = $request->input('item_id');
        $return->user_id = $request->input('user_id');

        // Save the return data to the database
        $return->save();

        // Redirect back or to a specific route after submission
        return redirect()->back()->with('success', 'Item Return successfully');
    }

    /**
     * Create New Return Grounds
     */
    public function storeReturnGrounds(Request $request)
    {
       $data = $request->validate([
            'title' => 'required|unique:return_grounds,title',
            'desc' => 'required|unique:return_grounds,desc',
       ]);

        ReturnGroundsModel::create($data);

        return redirect()->back()->with('success', 'Return Ground added successfully');
    }

    /**
     * Remove Retrun item
     */
    public function removereturnItem(Request $request)
    {
        $returnId = $request->input('id');
        $newStatus = $request->input('new_status');

        // Find the category by its ID
        $return = ReturnItemModel::find($returnId);

        if (!$return) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        // Update the category status
        $return->status = $newStatus;
        $return->save();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        DB::statement("SET SQL_MODE=''");
        $items = ItemModel::where('name', 'like', "%$query%")
                            ->where('status', 'Active')
                            ->groupby('name')
                            ->get();

        return response()->json($items);
    }


    public function Getmonthly()
    {
        return view('admin.monthly');
    }
    
}
