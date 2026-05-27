<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProductsControllerApi extends Controller
{
    public function index(): JsonResponse
    {
        $productList = Product::all();

        return response()->json([
            'success' => true,
            'message' => 'Lista de produtos',
            'data' => $productList,
        ]);
    }

    public function loginapi(Request $request): string
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

        return $user->createToken('token')->plainTextToken;
    }
}
