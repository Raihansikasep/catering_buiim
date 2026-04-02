<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $categories = ExpenseCategory::latest()->get();
        return view('admin.expense-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.expense-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        ExpenseCategory::create($request->only('name'));

        return redirect()->route('admin.expense-categories.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(ExpenseCategory $expenseCategory)
    {
        return view('admin.expense-categories.show', compact('expenseCategory'));
    }

    public function edit(ExpenseCategory $expenseCategory)
    {
        return view('admin.expense-categories.edit', compact('expenseCategory'));
    }

    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $expenseCategory->update($request->only('name'));

        return redirect()->route('admin.expense-categories.index')
                         ->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();

        return redirect()->route('admin.expense-categories.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}
