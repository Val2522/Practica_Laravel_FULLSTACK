<?php
/**
 * ArticlesController.php
 *
 * Controlador de artículos que maneja todas las operaciones CRUD:
 * - Listado filtrado por usuario autenticado
 * - Creación y edición de artículos (solo propietarios)
 * - Visualización pública de artículos
 * - Eliminación (solo propietarios)
 */

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
// Importo Auth para obtener el id del usuario autenticado
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    // Aplico middleware de autenticación a las acciones que leen o alteran datos propios.
    // Dejo el detalle (show) público si quisieras compartir enlaces, pero el resto
    // exige sesión para proteger edición/creación/borrado y el listado personal.
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    // Método que recupera todos los artículos y los pasa a la vista
    public function index()
    {
        // Recupero solo los artículos del usuario autenticado.
        // Como la ruta está protegida con auth, Auth::id() siempre tendrá valor.
        $articles = Article::where('user_id', Auth::id())->get();
        
        // Paso los artículos a la vista de listado
        return view('articles.index', ['articles' => $articles]);
    }

    // Método que busca un artículo por ID y lo pasa a la vista
    public function show($id)
    {
        // Busco el artículo por ID con Eloquent.
        $article = Article::find($id);

        // Si no existe, redirijo al listado con un mensaje claro
        if (!$article) {
            return redirect('/articles')->with('error', 'Artículo no encontrado');
        }
        
        // Paso el artículo a la vista de detalle
        return view('articles.show', ['article' => $article]);
    }

    // Método que muestra el formulario para crear un nuevo artículo
    public function create()
    {
        // Muestro la vista del formulario de creación.
        // Ruta protegida en web.php: solo usuarios autenticados acceden al formulario.
        return view('articles.create');
    }

    // Método para mostrar el formulario de edición (solo dueño del artículo)
    public function edit($id)
    {
        // Busco el artículo y verifico propiedad del usuario actual
        $article = Article::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$article) {
            return redirect()->route('articles.index')->with('error', 'No puedes editar este artículo');
        }

        // Reutilizo la misma vista de creación, pasando el artículo para precargar campos
        return view('articles.create', ['article' => $article]);
    }

    // Método que valida y guarda un nuevo artículo en la BD
    public function store(Request $request)
    {
        // Valido los datos del formulario (title, body, date, etc).
        // Si falla, Laravel devuelve al formulario con errores y old() rellenará los campos.
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'author' => 'required|max:255',
            'date' => 'required|date',
        ]);

        // Intento guardar el artículo.
        // Uso try/catch para mostrar mensajes claros de éxito/error.
        try {
            // Creo el nuevo artículo con Eloquent
            $article = new Article();
            $article->title = $validated['title'];
            $article->body = $validated['body'];
            $article->author = $validated['author'];
            $article->date = $validated['date'];
            // Guardo el id del usuario autenticado.
            // Antes lo forzaba a 1; ahora uso el id real del usuario logueado.
            $article->user_id = Auth::id();
            $article->save();

            // Redirijo a la lista de artículos con mensaje de éxito
            return redirect('/articles')->with('success', 'Artículo creado exitosamente');
        } catch (\Exception $e) {
            // Redirijo con mensaje de error si algo falla
            return redirect()->back()->with('error', 'Error al crear el artículo: ' . $e->getMessage());
        }
    }

    // Método que actualiza un artículo existente (solo dueño)
    public function update(Request $request, $id)
    {
        // Valido los datos igual que en store
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'author' => 'required|max:255',
            'date' => 'required|date',
        ]);

        // Busco el artículo del usuario autenticado
        $article = Article::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$article) {
            return redirect()->route('articles.index')->with('error', 'No puedes actualizar este artículo');
        }

        try {
            // Actualizo campos permitidos
            $article->update($validated);

            return redirect()->route('articles.index')->with('success', 'Artículo actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el artículo: ' . $e->getMessage());
        }
    }

    // Método que elimina un artículo de la BD
    public function destroy($id)
    {
        // Intento eliminar el artículo.
        // Método protegido: solo usuarios autenticados pueden borrar.
        try {
            // Busco el artículo por ID con Eloquent
            $article = Article::find($id);

            // Verifico que el artículo existe; si no, aviso y regreso al listado
            if (!$article) {
                return redirect('/articles')->with('error', 'Artículo no encontrado');
            }

            // Elimino el artículo
            $article->delete();

            // Redirijo a la lista de artículos con mensaje de confirmación
            return redirect('/articles')->with('success', 'Artículo eliminado exitosamente');
        } catch (\Exception $e) {
            // Redirijo con mensaje de error si algo falla
            return redirect()->back()->with('error', 'Error al eliminar el artículo: ' . $e->getMessage());
        }
    }
}
