$(document).ready(function () {
    const $totalPriceElement = $('.totalPriceFix');
    const $ordersInput = $('#ordersInput');
    let orders = [];
    let selectedProductId = null;

    closeButton.addEventListener('click', function () {
        document.getElementById('order').classList.add('hidden');
    });

    countElement.addEventListener('input', () => {
        const newCount = parseInt(countElement.value) || 1;
        const newTotal = price * newCount;
        priceProductElement.innerText = newTotal;
        countOrderFix.innerText = newCount;
        priceOrderFix.innerText = newTotal;
    });

    window.orderNow = function (id, productName, productImageSrc, productPrice) {
        const orderElement = document.getElementById('order');
        const nameProductElement = document.getElementById('nameProduct');
        const imageProductElement = document.getElementById('productImageOrder');
        const nameProductFix = document.getElementById('nameProductFix');
        const imgOrderFix = document.getElementById('imgOrderFix');

        if (orderElement.classList.contains('hidden')) {
            orderElement.classList.remove('hidden');
            selectedProductId = id;
            price = parseInt(productPrice);
            nameProductElement.innerText = productName;
            imageProductElement.src = productImageSrc;
            countElement.value = 1;
            priceProductElement.innerText = price;
            nameProductFix.innerText = productName;
            imgOrderFix.src = productImageSrc;
            countOrderFix.innerText = 1;
            priceOrderFix.innerText = price;
        } else {
            orderElement.classList.add('hidden');
        }
    };

    function renderOrderChart() {
        const $container = $('#orderChartContainer');
        $container.empty();
        let total = 0;

        orders.forEach((order, index) => {
            const chartHTML = `
                <div class="flex mt-5 rounded-lg p-3">
                    <div class="flex-1 h-20 overflow-hidden rounded-lg">
                        <img src="${order.image}" class="w-full object-cover" alt="Preview">
                    </div>
                    <div class="flex-1 mx-1 text-sm">
                        <p class="font-bold text-center">${order.name}</p>
                        <table class="w-full">
                            <tr>
                                <td class="font-bold w-[4rem]">Count</td>
                                <td class="font-bold px-1">:</td>
                                <td><p>${order.count}</p></td>
                            </tr>
                            <tr>
                                <td class="font-bold">Price</td>
                                <td class="font-bold px-1">:</td>
                                <td><p>${order.price}</p></td>
                            </tr>
                        </table>
                    </div>
                    <div class="flex-1 flex justify-end items-center">
                        <button class="removeOrder border-2 px-2 py-1 mx-1 rounded-md bg-[#cb172f] text-white hover:bg-red-500 font-bold border-[#cb172f]" data-index="${index}">
                            Remove
                        </button>
                    </div>
                </div>
            `;

            $container.append(chartHTML);
            total += order.price * order.count;
        });

        $totalPriceElement.text(`$ ${total.toLocaleString()}`);
        $ordersInput.val(JSON.stringify(orders));

        $('.order-count-input').off('input').on('input', function () {
            const index = $(this).data('index');
            const newCount = parseInt($(this).val());
            if (!isNaN(newCount) && newCount > 0) {
                orders[index].count = newCount;
                renderOrderChart();
            }
        });
    }

    $('#orderChartContainer').on('click', '.removeOrder', function () {
        const index = $(this).data('index');
        orders.splice(index, 1);
        renderOrderChart();
    });

    $('#checkoutForm').on('submit', function (e) {
        if (orders.length <= 0) {
            e.preventDefault();
            alert('Keranjang kosong! Silakan tambahkan barang.');
            return;
        }

        $ordersInput.val(JSON.stringify(orders));
    });
});
