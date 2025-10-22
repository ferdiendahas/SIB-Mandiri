<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'book')->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Resource data not found',
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Gel all resources',
            'data' => $transactions,
        ],);
    }

    public function store(Request $request){
        // 1. validaor & check validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 422);
        }

        // 2. generate order number -> unique | ORD-0003 
        $uniqueCode = "ORD-" . strtoupper(uniqid());

        // 3. ambil user yang sedang login & check login
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // 4. mencari data buku dari request
        $book = Book::find($request->book_id);

        // 5. check stok buku
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stock barang tidak cukup',
            ], 400);
        }

        // 6. hitung total harga = price * qty
        $totalAmount = $book->price * $request->quantity;

        // 7. kurangi stok buku (update)
        $book->stock -= $request->quantity;
        $book->save();

        // 8. simpan data transaksi
        $transaction = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $book->id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => $transaction,
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with('user', 'book')->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Resource data not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get resource detail',
            'data' => $transaction,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        // 1. find data
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }

        // 2. validation
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 422);
        }

        // 3. kembalikan stok lama buku
        $oldBook = Book::find($transaction->book_id);
        $oldBook->stock += $transaction->quantity;
        $oldBook->save();

        // 4. ambil buku baru (bisa sama / berbeda)
        $newBook = Book::find($request->book_id);

        if ($newBook->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stock barang tidak cukup',
            ], 400);
        }

        // 5. kurangi stok buku baru
        $newBook->stock -= $request->quantity;
        $newBook->save();

        // 6. hitung ulang total harga
        $totalAmount = $newBook->price * $request->quantity;

        // 7. update transaksi
        $transaction->book_id = $request->book_id;
        $transaction->quantity = $request->quantity;
        $transaction->total_amount = $totalAmount;
        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully',
            'data' => $transaction,
        ], 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found',
            ], 404);
        }
        // kembalikan stok buku
        $book = Book::find($transaction->book_id);
        $book->stock += $transaction->quantity;
        $book->save();

        $transaction->delete();


        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully',
        ], 200);
    }
    
}
