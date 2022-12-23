<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function getAll(): Collection
    {
        return Product::all();
    }

    public function getOne(int $id): Product
    {
        return Product::find($id);
    }

    public function store(array $data): void
    {
        Product::create($data);
    }

    public function update(int $id, array $data): void
    {
        $this->getOne($id)->update($data);
    }

    public function destroy(int $id): void
    {
        $this->getOne($id)->delete();
    }
}
