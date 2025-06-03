<ul class="space-y-2">
    <li>
        <button class="w-full text-left font-semibold text-green-700 flex justify-between items-center" onclick="toggleSubmenu(this)">
            Nhóm cha 1
            <span>+</span>
        </button>
        <ul class="ml-4 mt-1 hidden">
            <li><a href="#" class="block py-1 hover:text-green-600">Nhóm con 1-1</a></li>
            <li><a href="#" class="block py-1 hover:text-green-600">Nhóm con 1-2</a></li>
        </ul>
    </li>
    <li>
        <button class="w-full text-left font-semibold text-green-700 flex justify-between items-center" onclick="toggleSubmenu(this)">
            Nhóm cha 2
            <span>+</span>
        </button>
        <ul class="ml-4 mt-1 hidden">
            <li><a href="#" class="block py-1 hover:text-green-600">Nhóm con 2-1</a></li>
            <li><a href="#" class="block py-1 hover:text-green-600">Nhóm con 2-2</a></li>
        </ul>
    </li>
</ul>

<script>
    function toggleSubmenu(button) {
        const submenu = button.nextElementSibling;
        if (submenu.classList.contains('hidden')) {
            submenu.classList.remove('hidden');
            button.querySelector('span').textContent = '-';
        } else {
            submenu.classList.add('hidden');
            button.querySelector('span').textContent = '+';
        }
    }
</script>
