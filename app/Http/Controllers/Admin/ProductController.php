<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->sendApiResponse($this->productRepository->index($request));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendApiResponse($this->productRepository->store($request), 'Product Insert Successfully!');
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Product $product): \Illuminate\Http\JsonResponse
    {

        return $this->sendApiResponse($this->productRepository->update($request, $product), 'Product Updated Successfully!');
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product): \Illuminate\Http\JsonResponse
    {
        $product->delete();
        return $this->sendApiResponse(null, 'Product Deleted Successfully!');
    }
}
