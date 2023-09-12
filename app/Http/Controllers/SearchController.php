<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search\SearchRequest;
use App\Models\Product;
use App\Services\SearchProductService\SearchProductService;
use App\Traits\searchProductsHelper;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{

    public function search(SearchRequest $request, SearchProductService $searchProductService): JsonResponse
    {
        $searchData = $request->validated();

        $products = $searchProductService
            ->search()
            ->setSearchField($searchData['search_field'])
            ->run();

        return response()->json(['data' => $products]);
    }

}
