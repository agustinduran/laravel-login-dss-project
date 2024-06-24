<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Saved Grades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="px-4 py-2">Estudiante</th>
                                <th class="px-4 py-2">Materia</th>
                                <th class="px-4 py-2">Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td class="border px-4 py-2">{{ $grade->student->first_name }} {{ $grade->student->last_name }}</td>
                                    <td class="border px-4 py-2">{{ $grade->subject->name }}</td>
                                    <td class="border px-4 py-2">{{ $grade->score }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>