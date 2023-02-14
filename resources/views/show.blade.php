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
                <a href="javascript:history.back()" class="refresh-button inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Назад
                </a>
            </div>
        </div>
        <div class="mb-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg bg-white">
                        <div class="text-xl bg-gray-100 border-b border-gray-300 text-center py-2">{{ $bidding->debtor }} (идентификационный номер: {{ $bidding->number }})</div>
                        <div class="px-5 py-3 show-bidding">
                            {!! $bidding->details !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
