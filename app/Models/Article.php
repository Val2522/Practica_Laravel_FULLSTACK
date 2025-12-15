<?php
/**
 * Article.php
 *
 * Modelo de artículos. Representa los posts/artículos de la aplicación.
 * Cada artículo pertenece a un usuario (user_id) y contiene:
 * título, contenido (body), autor y fecha.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	// Ajusto el modelo para usar la tabla y columnas que empleamos en el controlador
	// (por defecto Laravel usa la tabla "articles" y la PK "id").

	// Permitimos asignación masiva de los campos que gestionamos en formularios
	protected $fillable = [
		'title',
		'body',
		'author',
		'date',
		'user_id',
	];

}
