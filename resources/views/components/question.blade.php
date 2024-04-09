@props([
    'question'
])

<div class="block p-6 bg-white border border-gray-200 rounded-lg shadow shadow-blue-500/50
                     hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700
                     dark:hover:bg-gray-700">

    <p class="font-normal text-gray-700 dark:text-gray-400">{{ $question->question }}</p>

</div>
