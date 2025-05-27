<x-layouts.app :title="__('Cashier Dashboard')">
    <div class="mb-4">
        <label for="category" class="font-semibold ml-[2rem] text-[1.2rem] mr-[1rem] text-gray-800 dark:text-gray-200">
            Filter by Category
        </label>
        <select id="category" name="category"
            class="p-2 border border-gray-300 dark:border-gray-600 rounded-md 
                bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 transition duration-300">
            <option value="all">-- All Categories --</option>
            @foreach($items as $categoryName => $groupedItems)
                <option value="{{ $categoryName }}">{{ $categoryName }}</option>
            @endforeach
        </select>
    </div>
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif
    @foreach($items as $categoryName => $groupedItems)
    
        <div class="category-group" data-category="{{ $categoryName }}">
            <h2 class="text-xl font-bold text-[#D1293F] ml-4 my-4">{{ $categoryName }}</h2>
            <div class="flex flex-wrap gap-4 px-4">
                @foreach($groupedItems as $item)
                    <x-card-product :datum="$item" />
                @endforeach
            </div>
        </div>

    @endforeach

    <x-form-order/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function filterCategory() {
        const selected = $('#category').val();

        $('[data-category]').each(function () {
            const category = $(this).data('category');

            if (selected === 'all' || category === selected) {
                $(this).show(); 
            } else {
                $(this).hide(); 
            }
        });
    }

    $(document).ready(function () {
        filterCategory();
        $('#category').on('change', filterCategory);
    });
    </script>
</x-layouts.app >