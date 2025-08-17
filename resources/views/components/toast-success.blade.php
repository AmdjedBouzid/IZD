<div 
    x-data="{ show: true }" 
    x-init="setTimeout(() => show = false, 3000)" 
    x-show="show" 
    x-transition 
    class="fixed top-20 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg transition ease-in-out duration-300"
>
    ✅ {{ $message }}
</div>
