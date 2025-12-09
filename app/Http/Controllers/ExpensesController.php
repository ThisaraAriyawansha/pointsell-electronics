<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Expense_categorie;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class ExpensesController extends Controller
{
    public function expenses()
    {
        return view('expenses.expenses');
    }
    public function expensesList()
{
    $expenses = Expense::with('category')->get(); // Load expenses with category details
    $categories = Expense_categorie::all(); // Load all categories

    return view('expenses.expensesList', [
        'expenses' => $expenses, // Correct variable name
        'categories' => $categories
    ]);
}

    public function addExpense()
    {
        
        $categorie = Expense_categorie::all();
        return view('expenses.addExpense', compact('categorie'));
    } 

    

public function insertExpense(Request $request)
{
    $validator = Validator::make($request->all(), [
        'expense_date' => 'required|date',
        'expense_title' => 'required|string|max:255',
        'exp_cat' => 'required|exists:expense_categories,id', // Ensure this ID exists
        'amount' => 'required|numeric|min:0',
        'details' => 'nullable|string',
    ]);
    
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    try {
        // Reformat the date to Y-m-d for MySQL
        $expenseDate = Carbon::createFromFormat('m/d/Y', $request->expense_date)->format('Y-m-d');

        Expense::create([
            'expense_date' => $expenseDate,
            'expense_title' => $request->expense_title,
            'expense_categories_id' => $request->exp_cat,
            'amount' => $request->amount,
            'details' => $request->details,
            'user_id' => auth()->id(), // Ensure user is authenticated
        ]);

        return redirect()->back()->with('success', 'Expense added successfully');
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to add expense: ' . $e->getMessage());
    }
}


    
    public function editExpense($id)
    {
        $expenses = Expense::findOrFail($id);
        $categorie = Expense_categorie::all();
        return view('expenses.updateExpense', compact('expenses' , 'categorie'));
    }

    public function updateExpense($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'expense_title' => 'required|string|max:255|unique:expense_categories,name',
        ], [
            'expense_title.required' => 'Expense field is required.',
            'expense_title.unique' => 'Expense already exists.',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $expenses = Expense::getSingle($id);
        $expenses->expense_date = trim($request->expense_date);
        $expenses->expense_title = trim($request->expense_title);
        $expenses->expense_categories_id = trim($request->exp_cat);
        $expenses->amount = trim($request->amount);
        $expenses->details = trim($request->details);
        $expenses->save();

        return redirect('expenses/expensesList')->with('success', "Expense successfully Updated");
    }

    public function delete_expenses($id)
{
    
        $expenses = Expense::findOrFail($id);
        $expenses->delete();

     
        return redirect('expenses/expensesList')->with('success', "Expense successfully delete");

}

    
    public function expenseCategoryList()
    {
        $data = Expense_categorie::all();
        return view('expenses.expenseCategoryList',['expense_categories'=>$data]);
    }
    
    public function addExpenseCategory()
    {
        return view('expenses.addExpenseCategory');
    }
    

     // Ensure this matches your model name

     public function insertExpenseCategory(Request $request)
     {
         // Validate the input
         $validator = Validator::make($request->all(), [
             'name' => 'required|string|max:255|unique:expense_categories,name',
         ], [
             'name.required' => 'Expense Category field is required.',
             'name.unique' => 'Expense Category already exists.',
         ]);
     
         if ($validator->fails()) {
             return back()->withErrors($validator)->withInput();
         }
     
         try {
             // Create a new expense category
             Expense_categorie::create([
                 'name' => $request->name,
                 'user_id' => auth()->id(), // Make sure user is authenticated
             ]);
     
             return redirect()->back()->with('success', 'Expense Category successfully added!');
         } catch (\Exception $e) {
             \Log::error('Expense Category Error: ' . $e->getMessage());
             return back()->with('error', 'Failed to add Expense Category. Please try again later.');
         }
     }
    
    public function editExpenseCategory($id)
    {
        $categorie = Expense_categorie::findOrFail($id);
        return view('expenses.updateExpenseCategory', compact('categorie'));
        
    }
    public function updateExpenseCategory($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:expense_categories,name',
        ], [
            'name.required' => 'Expense Category field is required.',
            'name.unique' => 'Expense Category already exists.',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $categorie = Expense_categorie::getSingle($id);
        $categorie->name = trim($request->name);
        $categorie->save();

        return redirect('expenses/expenseCategoryList')->with('success', "Category successfully Updated");
    }
    public function delete_category($id)
{
    $category = Expense_categorie::findOrFail($id);

    // Delete all related expenses
    $category->expenses()->delete();

    // Now delete the category
    $category->delete();

    return redirect('expenses/expenseCategoryList')
        ->with('success', 'Category expenses successfully deleted.');
}


public function expenses_delete($id)
{
    try {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        
        return response()->json(['success' => true, 'message' => 'Expense deleted successfully!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'An error occurred while deleting the Expense.']);
    }
}

}
