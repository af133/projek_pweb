 <div class="mb-4">
        <select id="category" name="category"
            class="p-2 border border-[#51de00] dark:border-gray-600 rounded-md 
                bg-[#235e008e] dark:bg-gray-800 text-[white] dark:text-gray-100 transition duration-300">
            <option value="all">Filter</option>
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
    <div class="flex">
        <div class="flec-2">
        @foreach($items as $categoryName => $groupedItems)
        <div class="category-group" data-category="{{ $categoryName }}">
            <h2 class="text-xl font-bold text-[#225E00] ml-4 my-4">{{ $categoryName }}</h2>
            <div class="flex flex-wrap gap-4 px-4">
                @foreach($groupedItems as $item)
                    <x-card-product :datum="$item" />
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
        <div class="flex">
            <x-form-order/>
        </div>
    </div>

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