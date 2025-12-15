<?php
/**
 * User.php
 *
 * Modelo de usuario. Gestiona la autenticación y datos del usuario.
 * Incluye el cast 'hashed' para guardar contraseñas de forma segura
 * (no se guarda el texto plano, sino su hash irreversible).
 */

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // "hashed": Laravel guardará automáticamente la contraseña como hash seguro.
            // Un hash es un resumen criptográfico irreversible: no permite obtener
            // la contraseña original. Para verificar, se usa Hash::check() comparando
            // el texto introducido con el hash almacenado.
            'password' => 'hashed',
        ];
    }
}
