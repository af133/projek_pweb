$(document).ready(function () {
    const $totalPriceElement = $('.totalPriceFix');
    const $ordersInput = $('#ordersInput');
    let orders = [];

    window.orderNow = function (id, productName, productImageSrc, productPrice) {
        const existingOrderIndex = orders.findIndex(order => order.id === id);

        if (existingOrderIndex !== -1) {
            orders[existingOrderIndex].count += 1;
        } else {
            orders.push({
                id: id,
                name: productName,
                image: productImageSrc,
                count: 1,
                price: parseInt(productPrice)
            });
        }

        renderOrderChart();
    };

    function renderOrderChart() {
        const $container = $('#orderChartContainer');
        $container.empty();
        let total = 0;

        orders.forEach((order, index) => {
            const chartHTML = `
                <div class="flex mt-5 rounded-lg p-3">
                    <div class="flex-1 h-20 overflow-hidden rounded-lg">
                        <img src="${order.image}" class="w-full h-full object-cover" alt="Preview">
                    </div>
                    <div class="flex-1 mx-2 text-sm">
                        <p class="font-bold text-center mb-2">${order.name}</p>
                        <table class="w-full">
                            <tr>
                                <td class="font-bold w-[4rem]">Count</td>
                                <td class="font-bold px-1">:</td>
                                <td>
                                    <input 
                                        type="number" 
                                        value="${order.count}" 
                                        min="1" 
                                        class="order-count-input w-16 px-2 py-1 border-2 border-gray-400 rounded-md focus:outline-none focus:border-blue-500" 
                                        data-index="${index}">
                                </td>
                            </tr>
                            <tr>
                                <td class="font-bold">Price</td>
                                <td class="font-bold px-1">:</td>
                                <td><p>$${order.price}</p></td>
                            </tr>
                        </table>
                    </div>
                    <div class="flex-1 flex justify-end items-center">
                        <button class="removeOrder border-2 px-2 py-1 mx-1 rounded-md bg-[#225E00] text-white hover:bg-red-500 font-bold border-[#225E00]" data-index="${index}">
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
