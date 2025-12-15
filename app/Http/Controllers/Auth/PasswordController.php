<?php
/**
 * PasswordController.php
 *
 * Controlador para cambiar la contraseña del usuario autenticado.
 * Usa el cast 'hashed' del modelo User para guardar contraseñas de forma segura.
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Actualiza la contraseña del usuario autenticado.
     *
     * Simplificado de la version que necesitaba contraseña actual pendiente de revision para la validacion *no olvidar*. 
     * User, con asignar el valor plano Laravel lo almacena como hash.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Con el cast 'hashed' en el modelo User, basta con asignar el valor plano
        $request->user()->update([
            'password' => $validated['password'],
        ]);

        return back()->with('status', 'password-updated');
    }
}
/**
 * Hash toma tu contraseña y la convierte en otra cadena irreconocible solo de ida para 
 * confirmar contraseñas toma la nueva introducida la hashea y la compara con el has que ya habia
**/