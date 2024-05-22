<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoriesController extends ApiController
{
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return $this->handleResponse(data: $categories, msg: __('Categories retrieved successfully'));
    }
}
