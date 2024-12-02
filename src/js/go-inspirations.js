document.addEventListener('DOMContentLoaded', function () {
    const wrap = document.querySelector('.inspirations');
    const container = document.querySelector('.inspirations-container');
    const grid = document.querySelector('#inspirations-grid');
    const sidebar = document.querySelector('#sidebar');
    const sidebarImage = document.querySelector('#sidebar-image');
    // const sidebarProduct = document.querySelector('#product');
    const sidebarProducts = document.querySelector('#sidebar-products .swiper-wrapper');
    const closeSidebar = document.querySelector('.colose-sidebar');

    const sidebarContent = document.querySelector('#sidebar-content');
    
    wrap.style.display = "block";

    function pokazWysokosc() {
    sidebarContent.style.maxHeight = (window.innerHeight - 130) + "px";

    }

    pokazWysokosc()
    window.addEventListener('resize', pokazWysokosc);
    function sidebarScroll(){
        const topPosition = container.getBoundingClientRect().top;
        if (topPosition < 0) {
            sidebarContent.style.overflow = 'auto';
        } else {
            sidebarContent.style.overflow = 'hidden';
        }
    }
    sidebarScroll()
    window.addEventListener('scroll', sidebarScroll);

    closeSidebar.addEventListener('click', function(){
        
        container.classList.remove('active');
        if (masonry) {
            masonry.reloadItems(); // Przeładuj elementy
            masonry.layout();      // Przywróć układ
        }
    });


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

        // // // Ustaw obraz w sidebarze
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
                    console.error('Error test:', response.data);
                    sidebarProducts.innerHTML = '';
                    
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
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
             spaceBetween: 15,
             pagination: {
                el: ".swiper-pagination--col",
                clickable: true,
              },
              breakpoints: {

                768: {
                  slidesPerView: 1,
                },
                1024: {
                  slidesPerView: 2,
                },
                1200: {
                  slidesPerView: 2,
                }
              }
        });

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
            const currentPage = parseInt(loadMoreBtn.getAttribute('data-page') || '1', 10) + 1;
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
