<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\Product\ValidIdRequest;
use App\Http\Services\ProductService;
use App\Http\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ApiTrait;

    protected ProductService $ProductService;

    public function __construct()
    {
        $this->ProductService = new ProductService();
    }

    public function index(): JsonResponse
    {
        try {
            $products = $this->ProductService->getAll();
            return $this->fullResponse(__('product.getAll'), $products->toArray());
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->ProductService->store($request->all());
            DB::commit();
            return $this->messageResponse(__('product.created'));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, true);
        }
    }

    public function show(ValidIdRequest $request, int $id): JsonResponse
    {
        try {
            $product = $this->ProductService->getOne($id);
            return $this->fullResponse(__('product.getOne'), $product->toArray());
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->ProductService->update($id, $request->all());
            DB::commit();
            return $this->messageResponse(__('product.updated'));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, true);
        }
    }

    public function delete(ValidIdRequest $request, int $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->ProductService->update($id, $request->all());
            DB::commit();
            return $this->messageResponse(__('product.deleted'));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, true);
        }
    }
}
