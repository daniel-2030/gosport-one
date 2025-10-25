<x-app-layout>
    <div class="py-12" style="padding-top: 6rem;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div style="padding:16px">
                    
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Gestión de Usuarios') }}
                        </h2>
                        
                        <a href="{{ route('usuarios.create') }}" 
                           class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition inline-flex items-center gap-2">
                            <span>➕</span> Nuevo Usuario
                        </a>
                    </div>

                    @if (session('ok'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            ✅ {{ session('ok') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <p class="font-bold">⚠️ Error:</p>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table id="usuarios" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Completo</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Documento</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $u)
                                    <tr>
                                        <td>{{ $u->id_usuario }}</td>
                                        <td>{{ $u->nombre }} {{ $u->apellidos }}</td>
                                        <td>{{ $u->correo }}</td>
                                        <td>{{ $u->telefono ?? 'N/A' }}</td>
                                        <td>
                                            @if($u->Tipo_Doc && $u->documento)
                                                {{ $u->Tipo_Doc }}: {{ $u->documento }}
                                            @else
                                                <span class="text-gray-400">Sin documento</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($u->rol)
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                                    {{ $u->rol->nombre_rol }}
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">
                                                    Sin rol
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex gap-2">
                                                <a href="{{ route('usuarios.edit', $u) }}" 
                                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-sm inline-flex items-center gap-1"
                                                   title="Editar usuario">
                                                    ✏️ Editar
                                                </a>
                                                
                                                <form action="{{ route('usuarios.destroy', $u) }}" 
                                                      method="POST" 
                                                      style="display:inline" 
                                                      onsubmit="return confirm('¿Está seguro de eliminar a {{ $u->nombre }} {{ $u->apellidos }}?')">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition text-sm inline-flex items-center gap-1"
                                                            title="Eliminar usuario">
                                                        🗑️ Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- jQuery + DataTables (CDN) --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(function() {
            $('#usuarios').DataTable({
                pageLength: 10,
                order: [[0, 'desc']], // Ordenar por ID descendente
                dom: 'Bfrtip',
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                },
                buttons: [
                    {
                        extend: 'copy',
                        text: '📋 Copiar',
                        className: 'btn-datatables'
                    },
                    {
                        extend: 'csv',
                        text: '📄 CSV',
                        className: 'btn-datatables'
                    },
                    {
                        extend: 'excel',
                        text: '📊 Excel',
                        className: 'btn-datatables'
                    },
                    {
                        extend: 'pdf',
                        text: '📕 PDF',
                        className: 'btn-datatables',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    {
                        extend: 'print',
                        text: '🖨️ Imprimir',
                        className: 'btn-datatables'
                    }
                ]
            });
        });
    </script>

    <style>
        body {
            background-color: #32373dff !important;
            color: white;
        }
        
        .bg-white {
            background-color: #32373dff !important;
        }

        .text-gray-800 {
            color: #fff !important;
        }

        /* Estilos DataTables */
        table.dataTable {
            color: white !important;
        }

        table.dataTable thead th {
            background-color: #1f2937 !important;
            color: white !important;
            border-bottom: 2px solid #4b5563 !important;
        }

        table.dataTable tbody td {
            border-bottom: 1px solid #374151 !important;
        }

        /* Quitar hover de filas */
        table.dataTable tbody tr:hover,
        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: transparent !important;
        }

        /* Controles de DataTables */
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            background-color: #374151 !important;
            color: white !important;
            border: 1px solid #4b5563 !important;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: white !important;
        }

        /* Botones de paginación */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: white !important;
            background: #374151 !important;
            border: 1px solid #4b5563 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #4b5563 !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #6366f1 !important;
            color: white !important;
            border: 1px solid #6366f1 !important;
        }

        /* Botones de exportación */
        .dt-buttons .btn-datatables {
            background-color: #4b5563 !important;
            color: white !important;
            border: 1px solid #6b7280 !important;
            padding: 6px 12px;
            margin: 2px;
            border-radius: 4px;
            font-size: 14px;
        }

        .dt-buttons .btn-datatables:hover {
            background-color: #6366f1 !important;
            border-color: #6366f1 !important;
        }

        /* Labels de DataTables */
        .dataTables_wrapper label {
            color: white !important;
        }
    </style>
</x-app-layout>