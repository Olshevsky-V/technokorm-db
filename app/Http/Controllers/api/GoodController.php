<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Http\Requests\StoreGoodRequest;
use App\Http\Requests\UpdateGoodRequest;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/goods
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $goods = Good::all();
            
            // Благодаря переопределенному toArray() в модели,
            // tags уже будут массивами, но добавим дополнительные проверки
            return response()->json([
                'success' => true,
                'data' => $goods,
                'message' => 'Товары успешно получены'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении товаров',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     * GET /api/goods/{id}
     * 
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $good = Good::find($id);
            
            if (!$good) {
                return response()->json([
                    'success' => false,
                    'message' => 'Товар не найден'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $good,
                'message' => 'Товар успешно получен'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении товара',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/goods
     * 
     * @param  \App\Http\Requests\StoreGoodRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGoodRequest $request)
    {
        try {
            // Валидация уже прошла в StoreGoodRequest
            $validated = $request->validated();
            
            // Создаем товар
            $good = Good::create($validated);
            
            return response()->json([
                'success' => true,
                'data' => $good,
                'message' => 'Товар успешно создан'
            ], 201); // 201 Created
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при создании товара',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * PUT/PATCH /api/goods/{id}
     * 
     * @param  \App\Http\Requests\UpdateGoodRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateGoodRequest $request, $id)
    {
        try {
            $good = Good::find($id);
            
            if (!$good) {
                return response()->json([
                    'success' => false,
                    'message' => 'Товар не найден'
                ], 404);
            }
            
            // Валидация уже прошла в UpdateGoodRequest
            $validated = $request->validated();
            
            // Обновляем товар
            $good->update($validated);
            
            return response()->json([
                'success' => true,
                'data' => $good,
                'message' => 'Товар успешно обновлен'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обновлении товара',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/goods/{id}
     * 
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $good = Good::find($id);
            
            if (!$good) {
                return response()->json([
                    'success' => false,
                    'message' => 'Товар не найден'
                ], 404);
            }
            
            // Удаляем товар
            $good->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Товар успешно удален'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении товара',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get goods by tag
     * GET /api/goods/by-tag/{tag}
     * 
     * @param  string $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByTag($tag)
    {
        try {
            // Получаем все товары и фильтруем по тегу
            $goods = Good::all()->filter(function ($good) use ($tag) {
                $tags = $good->tags;
                
                // Убеждаемся что это массив
                if (is_string($tags)) {
                    $tags = json_decode($tags, true) ?? [];
                }
                
                return in_array($tag, $tags);
            })->values(); // values() для переиндексации
            
            return response()->json([
                'success' => true,
                'data' => $goods,
                'count' => $goods->count(),
                'message' => 'Товары по тегу успешно получены'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при фильтрации товаров',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}