<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpenseCategory;

class ExpenseController extends Controller
{
    // Menampilkan semua expense
    public function index()
    {
        $expenses = Expense::with('category')->latest()->get();
        return view('admin.expenses.index', compact('expenses'));
    }

    // Form tambah expense
    public function create()
    {
        $categories = ExpenseCategory::all();
        return view('admin.expenses.create', compact('categories'));
    }

    // Simpan expense baru
    public function store(Request $request)
    {
        $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Expense::create($request->all());

        return redirect()->route('expenses.index')
                         ->with('success', 'Expense berhasil ditambahkan.');
    }

    // Detail expense
    public function show(Expense $expense)
    {
        $expense->load('category');
        return view('admin.expenses.show', compact('expense'));
    }

    // Form edit expense
    public function edit(Expense $expense)
    {
        $categories = ExpenseCategory::all();
        return view('admin.expenses.edit', compact('expense', 'categories'));
    }

    // Update expense
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $expense->update($request->all());

        return redirect()->route('expenses.index')
                         ->with('success', 'Expense berhasil diperbarui.');
    }

    // Hapus expense
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')
                         ->with('success', 'Expense berhasil dihapus.');
    }
}
