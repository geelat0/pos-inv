<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\SupplierModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public  function  index()
    {
        $categories = CategoryModel::all();
        return view('admin.admin', ['categories'=> $categories]);
    }

    public  function  item_category()
    {
        $categories = CategoryModel::all();
        return view('admin.item-category', ['categories'=> $categories]);
    }

    public  function  supplier()
    {
        $suppliers = SupplierModel::all();
        return view('admin.suppliers', ['suppliers'=> $suppliers]);
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

    /**
     * Create New Supplier
     */
    public function storeSupplier(Request $request)
    {
       $data = $request->validate([
            'supplier_name' => 'required|unique:supplier,supplier_name'
       ]);

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
        $supplierId = $request->input('id');
        $new_name = $request->input('supplier_name');
    
        // Check if the category name already exists, excluding the current category.
        $existingCategory = CategoryModel::where('supplier_name', $new_name)
            ->where('id', '!=', $supplierId)
            ->first();
    
        if ($existingCategory) {
            return redirect()->back()->with('error', 'Supplier Name already exists.');
        }
            // Update the category name if it doesn't already exist.
        $supplier = SupplierModel::find($supplierId);
        $supplier->supplier_name = $new_name;
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier updated successfully.');
    }
    
}
