<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Sales_item;
use App\Models\Stock_update;

class ReportsController extends Controller
{

    public function reports()
    {
        return view('reports.reports');
    }

    public function getStockReport()
    {
        // Fetch all items with necessary relationships
        $items = Item::with(['salesItems'])->get();

        $reportData = $items->map(function ($item) {
            $startingStock = $item->start_qty ?? 0;
        
            $purchasedStock = $startingStock + Stock_update::where('items_id', $item->id)
            ->sum('stock');
        
            $soldStock = $item->salesItems->sum('quantity');
        
            $endingStock = $item->quantity;
        
            $stockValue = $endingStock * $item->purchase_price;
            $soldStockValue = $soldStock * $item->retail_price;
        

            return [
                'id' => $item->id,
                'item_name' => $item->item_name,
                'starting_stock' => $startingStock,
                'purchased_stock' => $purchasedStock,
                'sold_stock' => $soldStock,
                'ending_stock' => $endingStock,
                'retail_price'=>$item->retail_price,
                'wholesale_price'=>$item->wholesale_price,
                'purchase_price'=>$item->purchase_price,
                'stock_value' => $stockValue,
                'price_per_item' => $item->purchase_price,
                'sold_stock_value' => $soldStockValue,
                'date' => $item->created_at ? $item->created_at->toDateString() : 'N/A',
            ];
        });
        
        $totalStockValue = $reportData->sum('stock_value');
        $totalPricePerItem = $reportData->sum('price_per_item');
        $totalSoldStockValue = $reportData->sum('sold_stock_value');

        return view('reports.stockReport', compact('reportData', 'totalStockValue', 'totalPricePerItem', 'totalSoldStockValue'));
    }

    public function filter(Request $request)
        {
            $query = Item::query();

            // Filter by item name (case-insensitive)
            if ($request->filled('item_name')) {
                $query->whereRaw('LOWER(item_name) LIKE ?', ['%' . strtolower($request->item_name) . '%']);
            }

            // Filter by date range
            if ($request->filled('from_date') && $request->filled('to_date')) {
                $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
            } elseif ($request->filled('from_date')) {
                $query->whereDate('created_at', '>=', $request->from_date);
            } elseif ($request->filled('to_date')) {
                $query->whereDate('created_at', '<=', $request->to_date);
            }

            $items = $query->with(['salesItems'])->get();

            $reportData = $items->map(function ($item) {
                $startingStock = $item->start_qty ?? 0;

                $purchasedStock = $startingStock + Stock_update::where('items_id', $item->id)
                ->sum('stock');

                $soldStock = $item->salesItems->sum('quantity');

                $endingStock = $item->quantity;

                $stockValue = $endingStock * $item->purchase_price;
                $soldStockValue = $soldStock * $item->retail_price;

                return [
                    'id' => $item->id,
                    'item_name' => $item->item_name,
                    'starting_stock' => $startingStock,
                    'purchased_stock' => $purchasedStock,
                    'sold_stock' => $soldStock,
                    'ending_stock' => $endingStock,
                    'retail_price'=>$item->retail_price,
                    'wholesale_price'=>$item->wholesale_price,
                    'purchase_price'=>$item->purchase_price,
                    'stock_value' => $stockValue,
                    'price_per_item' => $item->purchase_price,
                    'sold_stock_value' => $soldStockValue,
                    'date' => $item->created_at ? $item->created_at->toDateString() : 'N/A',
                ];
            });

            $totalStockValue = $reportData->sum('stock_value');
            $totalPricePerItem = $reportData->sum('price_per_item');
            $totalSoldStockValue = $reportData->sum('sold_stock_value');

            return view('reports.stockReport', compact('reportData', 'totalStockValue', 'totalPricePerItem', 'totalSoldStockValue'));
        }


}