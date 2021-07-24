<?php

namespace App\Interfaces;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request);

    public function store(ProductRequest $request);

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return Product
     */
    public function update(ProductRequest $request, Product $product);
}
