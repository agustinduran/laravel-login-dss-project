<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4">
                        <h1 class="text-xl font-bold mb-4">Calificaciones Importadas</h1>
                        <form method="POST" action="{{ route('grades.store') }}">
                            @csrf
                            <table class="min-w-full table-auto border-collapse border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-4 py-2">Seleccionar</th>
                                        <th class="border px-4 py-2">Estudiante</th>
                                        <th class="border px-4 py-2">Materia</th>
                                        <th class="border px-4 py-2">Calificación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grades as $index => $grade)
                                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                            <td class="border px-4 py-2 text-center"><input type="checkbox" name="selected_grades[]" value="{{ $index }}"></td>
                                            <td class="border px-4 py-2">{{ $grade['first_name'] }} {{ $grade['last_name'] }}</td>
                                            <td class="border px-4 py-2">{{ $grade['subject_name'] }}</td>
                                            <td class="border px-4 py-2 text-center">{{ $grade['score'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Guardar Selección
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selected_grades[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                let checkedCount = Array.from(checkboxes).filter(ch => ch.checked).length;
                if (checkedCount > 3) {
                    alert('Solo puedes seleccionar hasta 3 calificaciones.');
                    checkbox.checked = false;
                }
            });
        });
    });
</script>
