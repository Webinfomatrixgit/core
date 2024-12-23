<?php

namespace App\Http\Controllers\Backend;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\SupportCategory;
use Illuminate\Http\Request;

class SupportCategoryController extends Controller
{

    public function __construct()
    {
        // Define permissions for each action
        $permissions = [
            'index' => 'support-category-list',
            'store' => 'support-category-manage',
            'edit' => 'support-category-manage',
            'update' => 'support-category-manage',
            'destroy' => 'support-category-manage',
        ];
        $this->permissionAuthorization($permissions);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = SupportCategory::all();

        return view('backend.support_ticket.category.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = new SupportCategory;
        $category->name = $request->name;
        $category->save();
        notifyEvs('success', 'Category created successfully');

        return redirect()->route('admin.support-ticket.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupportCategory $category)
    {
        return view('backend.support_ticket.category.edit', compact('category'))->render();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $supportCategory = SupportCategory::find($id);
        $supportCategory->update([
            'name' => $request->name,
            'status' => $request->status ?? Status::INACTIVE,
        ]);
        notifyEvs('success', 'Category updated successfully');

        return redirect()->route('admin.support-ticket.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supportCategory = SupportCategory::find($id);
        $supportCategory->delete();
        notifyEvs('success', 'Category deleted successfully');

        return redirect()->route('admin.support-ticket.category.index');
    }
}
