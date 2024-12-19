<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function allReport()
    {
        $products = Product::with('orders', 'factors', 'comments')->get();

        $reports = [];

        foreach ($products as $product) {
            $soldTicketsCount = $product->orders()->count();

            $totalSales = $product->factors()->where('product_id', $product->id)->sum('total_price');

            $reviewsCount = $product->comments()->count();

            $averageRating = $product->comments()->avg('star') ?: 0; // Default to 0 if no reviews

            $reports[] = [
                'product' => $product->name,
                'soldTicketsCount' => $soldTicketsCount,
                'totalSales' => $totalSales,
                'reviewsCount' => $reviewsCount,
                'averageRating' => $averageRating,
            ];
        }

        return response()->json($reports);
    }
    public function show(Request $request,$productId)
    {
        $product = Product::findOrFail($productId);

        // Get start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Retrieve count of tickets sold grouped by date
        $ticketsSold = Order::whereBetween('day_reserved', [$startDate, $endDate])
            ->selectRaw('DATE(day_reserved) as date, COUNT(*) as total_sold')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Retrieve the most reserved sans within the date range
        $mostReservedSans = Order::whereBetween('day_reserved', [$startDate, $endDate])
            ->selectRaw('sans_id, COUNT(*) as total_reservations')
            ->groupBy('sans_id')
            ->orderBy('total_reservations', 'desc')
            ->get();

        // Calculate the average rating within the date range
        $averageRating = Comment::whereBetween('created_at', [$startDate, $endDate])
            ->avg('star');

        // Count of all comments within the date range
        $totalComments = Comment::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return response()->json([
            'ticketsSold' => $ticketsSold,
            'mostReservedSans' => $mostReservedSans,
            'averageRating' => $averageRating,
            'totalComments' => $totalComments,
        ]);
    }
}
