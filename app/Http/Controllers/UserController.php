<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Expense;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{
    //
    public function showExpenses($userId)
    {
        $user = User::find($userId);
        $expenses = $user->expenses;

        // Pass $expenses to a view for displaying
        return view('expenses.index', ['expenses' => $expenses]);
    }

   public function dashboard()
   {

    return view('dashboard');
   }
    public function store(Request $request)
    {

            // Validate the request data
            $userId = Auth::id();
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'moneyType' => 'required|in:income,expense',
                'amount' => 'required|numeric|min:0',
                'date' => 'required|date',
                'attachment' => 'required|file|max:2048|mimes:pdf,doc,docx,png,jpg,jpeg', // Adjust the allowed file types and maximum file size
            ]);

            // Handle file upload
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');

                // Store the file
                $path = $file->store('expense_attachments', 'public');

                // Save the file path in the database
                $validatedData['attachment'] = $path;
            }

            // Create a new expense record
            $expense = new Expense();
            $expense->user_id = $userId;
            $expense->Title = $validatedData['title'];
            $expense->Description = $validatedData['description'];
            $expense->Type = $validatedData['moneyType'];
            $expense->Amount = $validatedData['amount'];
            $expense->Date = $validatedData['date'];
            $expense->Document = $validatedData['attachment'] ?? null; // In case attachment is not provided
            $expense->save();

            // Log success message

            // Redirect back or to a specific route
            return redirect()->route('users.dashboard')->with('success', 'Expense added successfully.');
        }


     public function index()
     {
        return view('users.index');
     }

     public function welcome()
     {
        //  $expenseData = Expense::paginate(5);

        //  return view('users.index', compact('expenseData'));
        $userId = auth()->id();

        // Fetch expense data for the authenticated user only
        $expenseData = Expense::where('user_id', $userId)->paginate(5);

        return view('users.index', ['expenseData' => $expenseData]);
     }

     public function edit($userId)
     {
         // Fetch the expense data for the given user id from the database
         $expense = Expense::find($userId);

         // Check if expense exists
         if (!$expense) {
             // If expense does not exist, return an error message or redirect to some error page
             return response()->json(['error' => 'Expense not found'], 404);
         }

         // If expense exists, return the view with the expense data
         return view('users.edit', ['expense' => $expense]);
     }

     public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'type' => 'required|in:income,expense',
        'amount' => 'required|numeric',
        'date' => 'required|date',
        'attachment' => 'file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
    ]);

    // Find the expense by ID
    $expense = Expense::find($id);


    // Update the expense data
    $expense->Title = $request->title;
    $expense->Description = $request->description;
    $expense->Type = $request->type;
    $expense->Amount = $request->amount;
    $expense->Date = $request->date;
    $expense->Document = $request->attachment;

    // Check if a file was uploaded
    if ($request->hasFile('attachment')) {
        // Store the file in a storage location
        $filePath = $request->file('attachment')->store('attachments');

        // Update the file path in the database
        $expense->Document = $filePath;
    }

    // Save the updated expense
    $expense->save();

    // Redirect to the users.expense.index route
    return redirect()->route('users.expense.index')->with('success', 'Expense updated successfully');
}
public function destroy($userId)
{
    // Find the expense by ID and delete it
    $expense = Expense::find($userId);
    if (!$expense) {
        return response()->json(['error' => 'Expense not found'], 404);
    }
    $expense->delete();

    // Redirect back with a success message or handle as needed
    return redirect()->route('users.expense.index')->with('success', 'Expense deleted successfully');
}

}
