<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProductsControllerApi extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $products = Product::query()
            ->with('category')
            ->when($request->search, function ($query, string $search): void {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->category_id, function ($query, string $categoryId): void {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('name')
            ->get();

        return ProductResource::collection($products)->additional([
            'success' => true,
            'message' => 'Lista de produtos',
        ]);
    }

    public function show(Product $product): ProductResource
    {
        $product->load('category');

        return ProductResource::make($product)->additional([
            'success' => true,
            'message' => 'Produto encontrado',
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais sao invalidas.'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login realizado com sucesso.',
            'token' => $user->createToken('token')->plainTextToken,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function loginapi(Request $request): JsonResponse
    {
        return $this->login($request);
    }
}
