@extends('layouts.admin')

@section('header', 'Editar Usuario')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Editar Usuario</h1>
        <p class="text-gray-600">Actualiza la información de: <span class="font-semibold text-blue-600">{{ $user->name }}</span></p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 shadow-sm rounded-r-lg">
            <p class="font-bold">Por favor corrige los siguientes errores:</p>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="status" value="{{ $user->status ?? 'activo' }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Nombre Completo *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                           required>
                </div>

                <div>
                    <label for="username" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Nombre de Usuario *
                    </label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           value="{{ old('username', $user->username) }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                           required>
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Correo Electrónico *
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                           required>
                </div>

                <div>
                    <label for="role" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Rol del Sistema *
                    </label>
                    <select id="role" 
                            name="role" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none bg-white"
                            required>
                        <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Administrador</option>
                        <option value="empleado" {{ (old('role', $user->role) == 'empleado') ? 'selected' : '' }}>Empleado / Usuario</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Nueva Contraseña (Opcional)
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                           placeholder="Mínimo 8 caracteres">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Confirmar Contraseña
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                           placeholder="Repite la contraseña">
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-[11px] text-gray-400 font-medium">
                        <i class="fa-solid fa-clock mr-1"></i>
                        Creado: {{ $user->created_at->format('d/m/Y H:i') }} | 
                        Último cambio: {{ $user->updated_at->format('d/m/Y H:i') }}
                    </p>
                    
                    <div class="flex gap-3 w-full sm:w-auto">
                        <a href="{{ route('usuarios.index') }}" 
                           class="flex-1 sm:flex-none text-center px-6 py-2.5 border border-gray-200 rounded-xl text-gray-600 font-bold hover:bg-gray-50 transition-all text-sm">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="flex-1 sm:flex-none px-8 py-2.5 bg-slate-900 text-white rounded-xl font-bold shadow-lg shadow-slate-200 hover:bg-slate-800 transition-all text-sm flex items-center justify-center gap-2">
                            <i class="fa-solid fa-rotate mr-1"></i>
                            Actualizar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection