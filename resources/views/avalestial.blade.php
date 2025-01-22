<x-layout>
    <div class="h-96 w-full bg-white relative flex items-center justify-center">
        <div id="card-container" class="flex overflow-hidden w-[90%] h-60 gap-4 justify-evenly">
            <template id="card-template">
                <a href="#" class="relative group overflow-hidden w-80 h-full rounded-lg shadow-lg">
                    <img src="#" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-75 group-hover:bg-opacity-50 transition duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <p class="w-5/6 text-secondary text-opacity-75 text-2xl font-medium text-wrap text-center group-hover:text-opacity-100 group-hover:text-3xl transition duration-300 ease-in-out"></p>
                    </div>
                </a>
            </template>
        </div>
        <button id="left-button" class="ml-8 absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white rounded-full p-4 hover:bg-opacity-75">
            &lt;
        </button>
        <button id="right-button" class="mr-8 absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white rounded-full p-4 hover:bg-opacity-75">
            &gt;
        </button>
    </div>
</x-layout>
<script>
    const games = [
        { id: 1, name: 'Genshin Impact', img: '{{ asset("storage/img/img-genshin.png") }}' },
        { id: 2, name: 'Honkai Star Rail', img: '{{ asset("storage/img/img-starrail.png") }}' },
        { id: 3, name: 'Mobile Legends', img: '{{ asset("storage/img/img-mlbb.png") }}' },
        { id: 4, name: 'Wuthering Waves', img: '{{ asset("storage/img/img-wuwa.png") }}' },
        { id: 5, name: 'Girls Frontline 2', img: '{{ asset("storage/img/img-gfl2.png") }}' },
    ];

    const cardContainer = document.getElementById('card-container');
    const cardTemplate = document.getElementById('card-template');
    const leftButton = document.getElementById('left-button');
    const rightButton = document.getElementById('right-button');

    let currentIndex = 0;

    function renderCards() {
        // Debugging: Check if the container and template are available
        console.log('Rendering cards...');
        console.log('Card container:', cardContainer);
        console.log('Card template:', cardTemplate);

        // Clear previous cards
        cardContainer.innerHTML = '';

        const visibleGames = [
            games[currentIndex],
            games[(currentIndex + 1) % games.length],
            games[(currentIndex + 2) % games.length],
        ];

        // Debugging: Check which games are being rendered
        console.log('Visible games:', visibleGames);

        visibleGames.forEach(game => {
            const card = cardTemplate.content.cloneNode(true);
            const link = card.querySelector('a');
            const img = card.querySelector('img');
            const text = card.querySelector('p');

            // Check if card elements exist
            if (!link || !img || !text) {
                console.error('Card elements missing:', { link, img, text });
                return;
            }

            // Set card details
            link.href = `/products-list/${game.id}`;
            img.src = game.img;
            text.textContent = game.name;

            // Append card to container
            cardContainer.appendChild(card);
        });

        // Debugging: Check the container's content after rendering
        console.log('Card container content:', cardContainer.innerHTML);
    }

    function moveLeft() {
        currentIndex = (currentIndex - 1 + games.length) % games.length;
        renderCards();
    }

    function moveRight() {
        currentIndex = (currentIndex + 1) % games.length;
        renderCards();
    }

    leftButton.addEventListener('click', moveLeft);
    rightButton.addEventListener('click', moveRight);

    // Initial render
    renderCards();
</script>
  