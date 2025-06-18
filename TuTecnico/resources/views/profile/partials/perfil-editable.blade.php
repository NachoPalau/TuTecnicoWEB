<section>
  <div class=" m-5 d-flex justify-content-center align-items-center flex-column">

    <form method="post" action="{{ route('perfilProf', $profesional->user->id) }}" class="w-100" style="max-width: 480px;">
      @csrf
      

      <!-- Foto del perfil centrada -->
      <div class="text-center mb-4 mt-5">
        <img src="{{ asset('IMG/perfiles/FotoCurriculum.jpg') }}" class="rounded-circle border"
          style="width: 240px; height: 240px;" alt="Foto de perfil">
      </div>

      <div class="mb-3">
        <label for="photo" class="form-label fw-semibold">Cambiar foto de perfil</label>
        <input type="file" name="photo" id="photo" class="form-control">
        <x-input-error class="text-danger mt-1" :messages="$errors->get('photo')" />
      </div>

      <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        <x-input-error class="text-danger mt-1" :messages="$errors->get('name')" />
      </div>

      <div class="mb-3">
        <label for="especialidad" class="form-label fw-semibold">Especialidad</label>
        <select id="especialidad" name="especialidad" class="form-select">
          @foreach(\App\Models\Profesional::especialidades as $op)
          <option value="{{ $op }}" {{ old('especialidad', $user->profesional->especialidad ?? '') === $op ? 'selected' : '' }}>
            {{ $op }}
          </option>
          @endforeach
        </select>
        <x-input-error class="text-danger mt-1" :messages="$errors->get('especialidad')" />
      </div>

      <div class="mb-3">
        <label for="localidad" class="form-label fw-semibold">Localidad</label>
        <select id="localidad" name="localidad" class="form-select">
          @foreach(\App\Models\User::localidades as $loc)
          <option value="{{ $loc }}" {{ old('localidad', $user->localidad ?? '') === $loc ? 'selected' : '' }}>
            {{ $loc }}
          </option>
          @endforeach
        </select>
        <x-input-error class="text-danger mt-1" :messages="$errors->get('localidad')" />
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label fw-semibold">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="4" class="form-control">{{ old('descripcion', $user->profesional->descripcion ?? '') }}</textarea>
        <x-input-error class="text-danger mt-1" :messages="$errors->get('descripcion')" />
      </div>

      <button type="submit" class="btn btn-primary w-100 ">Guardar cambios</button>
    </form>

  </div>
</section>
