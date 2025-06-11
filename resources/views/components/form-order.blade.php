<div id="order" class="fixed right-4 top-[5rem] w-[23rem]  bg-[rgb(234,239,196)]  border-2 p-2 h-[calc(100vh-5rem)] z-50  text-zinc-950 overflow-y-auto">

  
    <h1 class="font-bold text-[1.3rem] ">Keranjang</h1> 
    {{--------------  Order cart  --------------}}

    <div class="p-1">
       <div id="orderChartContainer" class="space-y-2 mt-2">
        </div>
    </div>
    <div class="h-0 w-full border-t-2 border-dashed  border-gray-400 mt-4"></div>
    <p>Total: 
        <span class="totalPriceFix"></span>
    </p>
    <div class="h-0  w-full border-t-2 border-dashed border-gray-400 "></div>
    
    
    <div class="flex">
        <form  class="flex-1 flex justify-center items-center" id="checkoutForm" method="POST" action="{{ route('checkout') }}">
            @csrf
            <input type="hidden" name="orders" id="ordersInput">
            <button type="submit" class="my-4 border-2 bg-[#225E00] text-white font-bold py-2 px-4 rounded-md hover:bg-transparent hover:border-2 hover:border-[#225E00] hover:text-[#225E00] w-full">
                Checkout
            </button>
        </form>
    </div>
</div> 