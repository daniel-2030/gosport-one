<x-app-layout>
    <br><br><br><br><br>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div style="padding:16px">
                    <div class="flex items-center justify-center gap-4 mb-4">
                        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
                            🏆 Gestión de Ligas
                        </h2>
                    </div>

                    <p class="mb-4 text-center">
                        <a href="{{ route('ligas.create') }}" 
                           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                           + Nueva Liga
                        </a>
                    </p>

                    @if (session('ok'))
                        <div class="bg-green-600 text-white text-center py-2 rounded mb-4">
                            {{ session('ok') }}
                        </div>
                    @endif

                    <table id="ligas" class="display w-full text-white">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Temporada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ligas as $liga)
                                <tr>
                                    <td>{{ $liga->nombre }}</td>
                                    <td>{{ $liga->descripcion }}</td>
                                    <td>{{ $liga->temporada->nombre ?? 'Sin temporada' }}</td>
                                    <td>
                                        {{-- 🔧 CORREGIDO: Asegura que pasa el ID correctamente --}}
                                        <a href="{{ route('ligas.edit', $liga->id_liga) }}" 
                                           class="text-blue-400 hover:underline">✏️ Editar</a>

                                        <form action="{{ route('ligas.destroy', $liga->id_liga) }}" 
                                              method="POST" 
                                              style="display:inline" 
                                              onsubmit="return confirm('¿Eliminar esta liga?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-500 hover:underline bg-transparent border-none cursor-pointer">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

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
            $('#ligas').DataTable({
                pageLength: 20,
                dom: 'Bfrtip',
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                },
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>

    <style>
        body {
            background-color: #32373dff !important;
            color: white;
        }

        img {
            width: 50px;
            height: 50px;
        }

        .bg-white {
            background-color: #32373dff !important;
        }

        .text-gray-800 {
            color: #fff !important;
        }

        /* Quitar el hover/resaltado de las filas */
        table.dataTable tbody tr:hover {
            background-color: transparent !important;
        }

        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: transparent !important;
        }

        /* Quitar el resaltado de las filas seleccionadas */
        table.dataTable tbody tr.selected,
        table.dataTable tbody tr.selected:hover {
            background-color: transparent !important;
        }

        a.bg-indigo-600 {
            text-decoration: none;
        }
    </style>

</x-app-layout>
