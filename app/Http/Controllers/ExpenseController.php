<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Expense;
use Illuminate\Support\Facades\Log;
class ExpenseController extends Controller
{
    //


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
            Log::info('Expense added successfully.');

            // Redirect back or to a specific route
            return redirect()->route('users.index')->with('success', 'Expense added successfully.');
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






