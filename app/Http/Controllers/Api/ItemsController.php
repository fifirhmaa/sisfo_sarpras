<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Items::all();
        return response()->json([
            'data' => $items
        ]);
    }

    public function show($id)
    {
        $item = Items::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json($item);
    }

    public function byCategory($categoryId)
    {
        $items = Items::where('category_id', $categoryId)->get();

        if (!$items) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json([
            'dataCategory' => $items
        ]);
    }

    public function itemCount()
    {
        $itemCount = Items::all()->count();

        return response()->json(['itemCount' => $itemCount]);
    }

}
