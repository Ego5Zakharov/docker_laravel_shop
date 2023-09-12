<?php

namespace App\Services\SearchProductService;

use App\Services\SearchProductService\Actions\SearchProductsAction;

class SearchProductService
{
    public function search(): SearchProductsAction
    {
        return new SearchProductsAction;
    }
}
