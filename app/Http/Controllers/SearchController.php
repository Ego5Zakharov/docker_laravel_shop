<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search\SearchRequest;
use App\Models\Product;
use App\Services\SearchProductService\SearchProductService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{

    public function search(SearchRequest $request, SearchProductService $searchProductService): JsonResponse
    {
        $searchData = $request->validated();

        $searchValue = $request->input('q');
        $sortOption = $request->input('sort');
        $orderBy = $request->input('order');

        $products = $searchProductService
            ->search()
            ->setSearchField($searchData['search_field'])
            ->run();

        return response()->json([
            'data' => $products,
            'q' => $searchValue,
            'sort' => $sortOption, 'order' => $orderBy
        ]);
    }

    public function getAllProducts(): JsonResponse
    {
        return response()->json([
            'data' => Product::query()->paginate(12)
        ]);
    }

}
