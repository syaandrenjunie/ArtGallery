<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">

        <!-- Table Header -->
        <thead class="bg-gray-50">
            <tr>
                {{ $head }}
                <th class="px-6 py-3 text-left font-semibold text-gray-900 tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-700">
            {{ $body }}
        </tbody>

    </table>
</div>