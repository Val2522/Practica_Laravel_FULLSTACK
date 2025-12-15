<?php
/**
 * ProfileController.php
 *
 * Controlador para gestionar el perfil del usuario autenticado:
 * - Editar información del perfil (nombre, email)
 * - Actualizar datos personales
 * - Eliminar cuenta de usuario
 */

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Controlador de perfil de usuario.
     *
     * Aquí centralizo las acciones relacionadas con el perfil:
     * - edit(): muestra el formulario de perfil (datos + contraseña + eliminar cuenta)
     * - update(): guarda cambios de nombre/email (si cambia email, se invalida la verificación)
     * - destroy(): elimina la cuenta del usuario autenticado de forma segura
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Relleno el usuario con los datos validados del formulario
        $request->user()->fill($request->validated());

        // Si cambia el email, fuerzo volver a verificarlo
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Persisto cambios
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Valido la contraseña actual antes de borrar (bolsa de errores específica)
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Elimino el usuario
        $user->delete();

        // Cierro sesión e invalido la sesión actual
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
