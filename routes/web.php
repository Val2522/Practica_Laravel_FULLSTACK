<?php
/**
 * web.php
 *
 * Archivo de rutas principales de la aplicación.
 * Define todas las rutas web públicas y protegidas:
 * - Dashboard redirige al listado de artículos del usuario autenticado
 * - Rutas de artículos (CRUD) con protección auth donde corresponde
 * - Rutas de perfil de usuario
 * - Mantengo 'show' de artículos público para compartir enlaces
 */

use App\Http\Controllers\ProfileController;
// Importo el ArticleController para usarlo en la ruta de artículos
// Importo el controlador de artículos
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Tras el login, envío al listado de mis artículos
Route::get('/dashboard', function () {
    return redirect()->route('articles.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Listado de artículos del usuario autenticado
Route::get('/articles', [ArticlesController::class, 'index'])
    ->middleware('auth')
    ->name('articles.index');

// Formulario de creación (solo usuarios autenticados)
Route::get('/articles/create', [ArticlesController::class, 'create'])->middleware('auth')->name('articles.create');

// Formulario de edición (solo dueño autenticado)
Route::get('/articles/{id}/edit', [ArticlesController::class, 'edit'])->middleware('auth')->name('articles.edit');

// Guardar nuevo artículo (solo usuarios autenticados)
Route::post('/articles', [ArticlesController::class, 'store'])->middleware('auth')->name('articles.store');

// Actualizar artículo existente (solo dueño autenticado)
Route::put('/articles/{id}', [ArticlesController::class, 'update'])->middleware('auth')->name('articles.update');

// Detalle público de artículo
Route::get('/articles/{id}', [ArticlesController::class, 'show'])->name('articles.show');

// Eliminar artículo (solo usuarios autenticados)
Route::delete('/articles/{id}', [ArticlesController::class, 'destroy'])->middleware('auth')->name('articles.destroy');

require __DIR__.'/auth.php';
