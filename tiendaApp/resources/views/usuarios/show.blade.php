@extends('layouts.admin')

@section('header', 'Detalles de Usuario')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
            <p class="text-gray-600">Detalles del usuario</p>
        </div>
        <a href="{{ route('usuarios.index') }}" 
           class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            Volver a Usuarios
        </a>
    </div>

    <!-- Mensajes -->
    @if(session('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
            {{ session('info') }}
        </div>
    @endif

    <!-- Tarjetas de información -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Información básica -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 lg:col-span-2">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">
                <i class="fa-solid fa-user mr-2 text-blue-500"></i> Información Básica
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">ID</p>
                        <p class="font-medium text-gray-800 bg-gray-50 p-2 rounded">{{ $user->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Nombre Completo</p>
                        <p class="font-medium text-gray-800 bg-gray-50 p-2 rounded">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Nombre de Usuario</p>
                        <p class="font-medium text-gray-800 bg-gray-50 p-2 rounded">{{ $user->username }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Email</p>
                        <p class="font-medium text-gray-800 bg-gray-50 p-2 rounded">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Rol</p>
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full 
                            {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800 border border-purple-200' : 'bg-blue-100 text-blue-800 border border-blue-200' }}">
                            <i class="fa-solid {{ $user->role == 'admin' ? 'fa-crown' : 'fa-user' }} mr-1"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Estado</p>
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                            <i class="fa-solid fa-circle-check mr-1"></i>
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de fechas -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">
                <i class="fa-solid fa-calendar-days mr-2 text-green-500"></i> Fechas
            </h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Creado</p>
                    <div class="flex items-center text-gray-800">
                        <i class="fa-solid fa-calendar-plus mr-2 text-gray-400"></i>
                        <span>{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->format('h:i A') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Actualizado</p>
                    <div class="flex items-center text-gray-800">
                        <i class="fa-solid fa-calendar-check mr-2 text-gray-400"></i>
                        <span>{{ $user->updated_at->format('d/m/Y') }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">{{ $user->updated_at->format('h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de edición -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">
                <i class="fa-solid fa-pen-to-square mr-2 text-yellow-500"></i> Editar Usuario
            </h2>
            <button type="button" 
                    onclick="toggleEditForm()" 
                    class="text-blue-600 hover:text-blue-800 flex items-center gap-2">
                <i class="fa-solid fa-edit"></i>
                <span>Editar</span>
            </button>
        </div>

        <form id="editForm" action="{{ route('usuarios.update', $user->id) }}" method="POST" class="hidden">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre Completo *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre de Usuario *
                    </label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           value="{{ old('username', $user->username) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email *
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rol -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                        Rol *
                    </label>
                    <select id="role" 
                            name="role" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuario</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña (opcional) -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Nueva Contraseña (dejar en blanco para no cambiar)
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirmar Nueva Contraseña
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="••••••••">
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" 
                        onclick="toggleEditForm()" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancelar
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-save"></i>
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>

    <!-- Acciones -->
    <div class="mt-6 flex justify-between items-center">
        <div class="text-sm text-gray-500">
            ID de usuario: <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $user->id }}</span>
        </div>
        
        @if(auth()->id() != $user->id)
        <form action="{{ route('usuarios.destroy', $user->id) }}" 
              method="POST" 
              onsubmit="return confirm('¿Estás seguro de desactivar este usuario?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-4 py-2 bg-red-100 text-red-700 border border-red-200 rounded-lg hover:bg-red-200 transition-colors flex items-center gap-2">
                <i class="fa-solid fa-user-slash"></i>
                Desactivar Usuario
            </button>
        </form>
        @else
        <div class="text-sm text-gray-500 italic">
            No puedes desactivar tu propia cuenta
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function toggleEditForm() {
        const form = document.getElementById('editForm');
        form.classList.toggle('hidden');
        
        // Si el formulario se muestra, hacer scroll a él
        if (!form.classList.contains('hidden')) {
            form.scrollIntoView({ behavior: 'smooth' });
        }
    }
    
    // Validación para no cambiar el rol del usuario actual
    document.addEventListener('DOMContentLoaded', function() {
        const currentUserId = {{ auth()->id() }};
        const userId = {{ $user->id }};
        
        if(currentUserId === userId) {
            const roleSelect = document.getElementById('role');
            if(roleSelect) {
                roleSelect.addEventListener('change', function() {
                    if(this.value !== 'admin') {
                        alert('No puedes cambiar tu propio rol de administrador.');
                        this.value = 'admin';
                    }
                });
            }
        }
    });
</script>
@endpush
@endsection