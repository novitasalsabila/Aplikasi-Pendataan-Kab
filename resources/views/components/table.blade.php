<div class="overflow-x-auto rounded-md border border-gray-200 shadow-sm">
    <table class="min-w-full text-sm text-gray-700 border-separate border-spacing-0">
        
        <!-- Header -->
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                {{ $head }}
            </tr>
        </thead>

        <!-- Body -->
        <tbody class="divide-y divide-gray-200">
            {{ $slot }}
        </tbody>
    </table>
</div>
