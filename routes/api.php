<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('v1/posts/all', function (Request $request) {
    return response()->json(Post::all());
});

Route::get('v1/posts/{id}', function (Request $request, $id) {
    return response()->json(Post::find($id));
});

Route::post('v1/posts', function (Request $request) {
    $post = Post::create([
        'user_id' => auth()->id(),
        'body' => $request->body,
    ]);
    return response()->json($post, 201);
})->middleware('auth:sanctum');

Route::put('v1/posts/{id}', function (Request $request, $id) {
    $post = Post::find($id);
    $post->update([
        'body' => $request->body,
    ]);
    return response()->json($post, 204);
})->middleware('auth:sanctum');
