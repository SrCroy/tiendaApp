<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Tienda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Sidebar fijo */
        #sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 50;
            overflow-y: auto;
        }
        
        /* Scrollbar personalizado para sidebar */
        #sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        #sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }
        
        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        
        #sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
        
        /* Scrollbar personalizado para contenido principal */
        #mainContent::-webkit-scrollbar {
            width: 8px;
        }
        
        #mainContent::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        #mainContent::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        #mainContent::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Contenido principal */
        #mainContent {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            overflow-y: auto;
            height: 100vh;
        }
        
        /* Sidebar colapsado */
        .sidebar-collapsed {
            width: 70px !important;
        }
        
        .sidebar-collapsed .sidebar-text,
        .sidebar-collapsed .logo-text,
        .sidebar-collapsed .user-info,
        .sidebar-collapsed .section-label {
            display: none !important;
        }
        
        .sidebar-collapsed .nav-item {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        
        .sidebar-collapsed .nav-icon {
            margin-right: 0 !important;
        }
        
        .sidebar-collapsed + #mainContent {
            margin-left: 70px;
        }
        
        /* Para móvil */
        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            #sidebar.sidebar-mobile-visible {
                transform: translateX(0);
            }
            
            #mainContent {
                margin-left: 0 !important;
            }
            
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }
            
            .overlay.active {
                display: block;
            }
        }
        
        /* Efecto hover en enlaces */
        .nav-item {
            transition: all 0.2s ease;
            border-radius: 8px;
        }
        
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(2px);
        }
        
        /* Enlace activo */
        .nav-item.active {
            background: rgba(59, 130, 246, 0.2);
        }
        
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #3b82f6;
            border-radius: 0 2px 2px 0;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Overlay para móvil -->
    <div id="overlay" class="overlay lg:hidden" onclick="toggleSidebarMobile()"></div>

    <div class="flex">
        <!-- Sidebar FIJO -->
        <aside id="sidebar" class="w-72 bg-gradient-to-b from-slate-900 to-slate-800 text-white flex flex-col h-screen">
            <!-- Encabezado -->
            <div class="p-5 border-b border-slate-700/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div class="logo-text">
                        <h1 class="text-xl font-bold">Mi Tienda</h1>
                        <p class="text-xs text-slate-400">Panel de Control</p>
                    </div>
                </div>
                <button id="toggleSidebarBtn" class="hidden lg:block text-slate-400 hover:text-white p-2 rounded hover:bg-white/10">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button onclick="toggleSidebarMobile()" class="lg:hidden text-slate-400 hover:text-white p-2 rounded hover:bg-white/10">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            
            <!-- Información de usuario -->
            <div class="user-info p-4 border-b border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 flex items-center justify-center font-bold">
                            A
                        </div>
                    </div>
                    <div>
                        <h3 class="font-medium">Administrador</h3>
                        <p class="text-xs text-slate-400">admin@tienda.com</p>
                    </div>
                </div>
            </div>
            
            <!-- Navegación -->
            <nav class="flex-1 p-4">
                <!-- Administración -->
                <div class="mb-6">
                    <p class="section-label text-xs uppercase text-slate-400 font-semibold mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-sliders text-xs"></i> Administración
                    </p>
                    <div class="space-y-1">
                        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative active">
                            <i class="nav-icon fa-solid fa-users w-5 text-center"></i>
                            <span class="sidebar-text flex-1">Usuarios</span>
                        </a>
                        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative">
                            <i class="nav-icon fa-solid fa-user-tie w-5 text-center"></i>
                            <span class="sidebar-text">Clientes</span>
                        </a>
                    </div>
                </div>
                
                <!-- Inventario -->
                <div class="mb-6">
                    <p class="section-label text-xs uppercase text-slate-400 font-semibold mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-boxes-stacked text-xs"></i> Inventario
                    </p>
                    <div class="space-y-1">
                        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative">
                            <i class="nav-icon fa-solid fa-layer-group w-5 text-center"></i>
                            <span class="sidebar-text">Categorías</span>
                        </a>
                        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative">
                            <i class="nav-icon fa-solid fa-box w-5 text-center"></i>
                            <span class="sidebar-text">Productos</span>
                        </a>
                        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative">
                            <i class="nav-icon fa-solid fa-right-left w-5 text-center"></i>
                            <span class="sidebar-text">Movimientos</span>
                        </a>
                    </div>
                </div>
                
                <!-- Operaciones -->
                <div class="mb-6">
                    <p class="section-label text-xs uppercase text-slate-400 font-semibold mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-chart-line text-xs"></i> Operaciones
                    </p>
                    <div class="space-y-1">
                        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative">
                            <i class="nav-icon fa-solid fa-truck w-5 text-center"></i>
                            <span class="sidebar-text">Proveedores</span>
                        </a>
                        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative">
                            <i class="nav-icon fa-solid fa-bag-shopping w-5 text-center"></i>
                            <span class="sidebar-text">Compras</span>
                        </a>
                        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative">
                            <i class="nav-icon fa-solid fa-cash-register w-5 text-center"></i>
                            <span class="sidebar-text">Ventas</span>
                        </a>
                        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative">
                            <i class="nav-icon fa-solid fa-hand-holding-dollar w-5 text-center"></i>
                            <span class="sidebar-text">Préstamos</span>
                        </a>
                    </div>
                </div>
            </nav>
            
            <!-- Configuración -->
            <div class="p-4 border-t border-slate-700/50">
                <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 relative">
                    <i class="nav-icon fa-solid fa-gear w-5 text-center"></i>
                    <span class="sidebar-text">Configuración</span>
                </a>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <main id="mainContent" class="flex-1 min-h-screen">
            <!-- Header limpio - SIN buscador, SIN campanita, SIN números -->
            <header class="h-16 bg-white shadow-sm border-b border-gray-200 flex items-center justify-between px-6 sticky top-0 z-40">
                <div class="flex items-center gap-3">
                    <button id="mobileMenuBtn" class="lg:hidden text-gray-600 hover:text-gray-900 p-2">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                    <h2 class="text-lg font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                </div>
                
                <div class="flex items-center gap-4">
                    <!-- Usuario - SIN notificaciones, SIN números -->
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-800">Administrador</p>
                            <p class="text-xs text-gray-500">Admin</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold">
                            A
                        </div>
                    </div>
                </div>
            </header>

            <!-- Contenido Dinámico -->
            <div class="p-6 bg-gray-50">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Estado del sidebar
        let sidebarCollapsed = false;
        
        // Toggle sidebar en desktop
        document.getElementById('toggleSidebarBtn').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebarCollapsed = !sidebarCollapsed;
            
            if (sidebarCollapsed) {
                sidebar.classList.add('sidebar-collapsed');
                this.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
            } else {
                sidebar.classList.remove('sidebar-collapsed');
                this.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
            }
        });
        
        // Toggle sidebar en móvil
        function toggleSidebarMobile() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            if (sidebar.classList.contains('sidebar-mobile-visible')) {
                sidebar.classList.remove('sidebar-mobile-visible');
                overlay.classList.remove('active');
            } else {
                sidebar.classList.add('sidebar-mobile-visible');
                overlay.classList.add('active');
            }
        }
        
        // Botón de menú móvil
        document.getElementById('mobileMenuBtn').addEventListener('click', toggleSidebarMobile);
        
        // Cerrar sidebar al hacer clic en enlace (móvil)
        document.querySelectorAll('.nav-item').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Actualizar título
                const pageTitle = this.querySelector('.sidebar-text').textContent;
                document.querySelector('h2').textContent = pageTitle;
                
                // Marcar como activo
                document.querySelectorAll('.nav-item').forEach(item => {
                    item.classList.remove('active');
                });
                this.classList.add('active');
                
                // Cerrar sidebar en móvil
                if (window.innerWidth < 1024) {
                    toggleSidebarMobile();
                }
            });
        });
        
        // Ajustar al cambiar tamaño de ventana
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                // En desktop, quitar overlay y mostrar sidebar
                document.getElementById('overlay').classList.remove('active');
                document.getElementById('sidebar').classList.remove('sidebar-mobile-visible');
            }
        });
        
        // Inicializar
        document.addEventListener('DOMContentLoaded', function() {
            // Asegurar que el contenido principal tenga scroll
            const mainContent = document.getElementById('mainContent');
            mainContent.style.height = window.innerHeight + 'px';
            
            // Ajustar altura al cambiar tamaño de ventana
            window.addEventListener('resize', function() {
                mainContent.style.height = window.innerHeight + 'px';
            });
        });
    </script>
</body>
</html>