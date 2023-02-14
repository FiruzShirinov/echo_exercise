<x-layout>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center my-5">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Реализация имущества банкротов</h1>
                <p class="mt-1 text-sm text-gray-700">Список составлен и обновлен с сайта kartoteka.ru</p>
            </div>
            <div class="hidden refresh-spinner">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25 stroke-indigo-300" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-100 fill-indigo-600" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-3 sm:flex-none">
                <a href="{{ route('refresh') }}" class="refresh-button inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Обновить
                </a>
            </div>
        </div>
        <div class="mb-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">№</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Организатор</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Должник</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Предмет торгов</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Состояние</th>
                                    <th scope="col" class="whitespace-nowrap relative py-3.5 pl-3 pr-4 sm:pr-6 text-left text-sm font-semibold text-gray-900">Начало приема заявок</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($biddings as $bidding)
                                    <tr class="hover:bg-indigo-100 cursor-pointer" onclick="window.location='{{ route('show', $bidding) }}'">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $bidding->number }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500">{{ $bidding->organizer }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500">{{ $bidding->debtor }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500">{{ $bidding->subject }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $bidding->status }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $bidding->started_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-3 py-4 text-sm text-gray-500">
                                            Список пуст
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $biddings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
