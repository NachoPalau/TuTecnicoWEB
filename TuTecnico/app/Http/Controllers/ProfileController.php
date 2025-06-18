<?php

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
     * Display the user's profile form.
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
    $user = $request->user();
    $user->fill($request->validated());

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('profile_photos', 'public');
        // Guardar $path en el modelo usuario o profesional según tu estructura
        $user->profile_photo_path = $path; // o ajusta según modelo
    }

    $user->save();

    // Actualizar profesional (si existe)
    if ($user->profesional) {
        $user->profesional->update([
            'especialidad' => $request->especialidad,
            'localidad' => $request->localidad,
            'descripcion' => $request->descripcion,
        ]);
    }

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
