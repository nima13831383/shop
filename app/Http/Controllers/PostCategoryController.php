<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Services\Api\Shop\ProductCategoryService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PostCategoryController extends Controller
{
    public function __construct() {}

    // GET /product-categories
    public function index() {}

    // POST /product-categories
    public function store(Request $request) {}

    // GET /product-categories/{id}
    public function show($id) {}

    // PUT /product-categories/{id}
    public function update(Request $request, $id) {}

    // DELETE /product-categories/{id}
    public function destroy($id) {}
}
