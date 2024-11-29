document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.inspirations-container');
    const grid = document.querySelector('#inspirations-grid');
    const sidebar = document.querySelector('#sidebar');
    const sidebarImage = document.querySelector('#sidebar-image');
    const sidebarProducts = document.querySelector('#sidebar-products ul');
    let masonry = null;

    // Inicjalizacja Masonry
    if (grid) {
        masonry = new Masonry(grid, {
            itemSelector: '.grid-item',
            columnWidth: '.grid-item',
            percentPosition: true
        });
    }

    // Funkcja obsługująca kliknięcia w elementy gridu
    function handleGridItemClick(event) {
        const item = event.currentTarget;
        const image = item.getAttribute('data-image');
        const inspirationId = item.getAttribute('data-id');

        // Sprawdź dostępność elementów sidebaru
        if (!sidebar || !sidebarImage || !sidebarProducts) {
            console.error('Sidebar elements are missing in DOM');
            return;
        }

        // Ustaw obraz w sidebarze
        sidebarImage.src = image;

        // Pobieranie produktów za pomocą AJAX
        const request = new XMLHttpRequest();
        request.open('POST', ajaxData.ajaxUrl, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.onload = function () {
            try {
                const response = JSON.parse(request.responseText);
                if (response.success) {
                    sidebarProducts.innerHTML = response.data;
                } else {
                    console.error('Error:', response.data);
                }
            } catch (e) {
                console.error('Invalid JSON:', request.responseText);
            }
        };
        request.send(`action=fetch_products&inspiration_id=${inspirationId}`);

        // Wyświetl sidebar
        // sidebar.classList.remove('hidden');
        container.classList.add('active');
        if (masonry) {
            masonry.reloadItems(); // Przeładuj elementy
            masonry.layout();      // Przywróć układ
        }
    }

    // Funkcja dodająca event listener do elementów gridu
    function addEventListenersToGridItems() {
        const items = document.querySelectorAll('.grid-item');
        items.forEach(item => {
            if (!item.classList.contains('listener-added')) {
                item.addEventListener('click', handleGridItemClick);
                item.classList.add('listener-added');
            }
        });
    }

    // Wywołaj funkcję dla początkowych elementów
    addEventListenersToGridItems();

    // Obsługa przycisku Load More
    const loadMoreBtn = document.querySelector('#load-more');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            const currentPage = parseInt(loadMoreBtn.getAttribute('data-page') || '1', 9) + 1;
            const request = new XMLHttpRequest();

            request.open('POST', ajaxData.ajaxUrl, true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.onload = function () {
                try {
                    // console.log('RAW Response:', request.responseText); // Logowanie surowej odpowiedzi
            
                    const response = JSON.parse(request.responseText); // Parsowanie JSON
                    // console.log('Parsed Response:', response); // Logowanie sparsowanej odpowiedzi
            
                    if (response.success) {
                        const div = document.createElement('div');
                        div.innerHTML = response.data.html; // Wstaw HTML z odpowiedzi
            
                        while (div.firstChild) {
                            grid.appendChild(div.firstChild); // Dodaj elementy do siatki
                        }
            
                        if (masonry) {
                            imagesLoaded(grid, function () {
                                masonry.reloadItems();
                                masonry.layout();
                            });
                        }
                        addEventListenersToGridItems();

                        loadMoreBtn.setAttribute('data-page', currentPage);
                        if (!response.data.has_more) {
                            loadMoreBtn.style.display = 'none';
                        }
                    } else {
                        // console.error('Error in response:', response.data);
                    }
                } catch (e) {
                    // console.error('Error parsing JSON:', e.message);
                    // console.error('RAW Response:', request.responseText); // Loguj nieprzetworzoną odpowiedź JSON
                }
            };
            
            
            request.send(`action=load_more_inspirations&page=${currentPage}`);
        });
    }
});