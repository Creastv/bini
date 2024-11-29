
var swiper = new Swiper(".catOne", {
    slidesPerView: 2,
    grid: {
        rows: 2,
      },
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
        nextEl: ".slider-nav--one .slider-nav__next",
        prevEl: ".slider-nav--one .slider-nav__prev",
      },
    breakpoints: {
        640: {
            navigation: false,
        },
        768: {
            slidesPerView: 2,
            grid: {
                rows: 2,
            },
            pagination: false,
             
        },
        1024: {
            slidesPerView: 3,
            grid: {
                rows: 2,
            },
            pagination: false,
        },
        1200: {
            slidesPerView: 3,
            grid: {
                rows: 2,
            },
            pagination: false,
        }
    }
  });

  var swiper = new Swiper(".catTwo", {
    slidesPerView: 2,
    grid: {
        rows: 2,
      },
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
        nextEl: ".slider-nav--two .slider-nav__next",
        prevEl: ".slider-nav--two .slider-nav__prev",
      },
    breakpoints: {
        640: {
            navigation: false,
        },
        768: {
            slidesPerView: 2,
            grid: {
                rows: 2,
            },
            pagination: false,
             
        },
        1024: {
            slidesPerView: 3,
            grid: {
                rows: 2,
            },
            pagination: false,
        },
        1200: {
            slidesPerView: 3,
            grid: {
                rows: 2,
            },
            pagination: false,
        }
    }
  });


  var swiper = new Swiper(".catTree", {
    slidesPerView: 2,
    grid: {
        rows: 2,
      },
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
        nextEl: ".slider-nav--tree .slider-nav__next",
        prevEl: ".slider-nav--tree .slider-nav__prev",
      },
    breakpoints: {
        640: {
            navigation: false,
        },
        768: {
            slidesPerView: 2,
            grid: {
                rows: 2,
            },
            pagination: false,
             
        },
        1024: {
            slidesPerView: 3,
            grid: {
                rows: 2,
            },
            pagination: false,
        },
        1200: {
            slidesPerView: 3,
            grid: {
                rows: 2,
            },
            pagination: false,
        }
    }
  });



document.addEventListener('DOMContentLoaded', function () {
    const selectedProducts = []; // Wybrane produkty (każda sztuka jako osobny element)
    const selectedSlots = document.querySelectorAll('.product-slot');
    const originalPriceElement = document.getElementById('original-price');
    const discountedPriceElement = document.getElementById('discounted-price');
    const checkoutButton = document.getElementById('checkout-button');

    // Kliknięcie w "+" lub "-"
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('quantity-minus') || e.target.classList.contains('quantity-plus')) {
            const productId = e.target.getAttribute('data-id');
            const inputField = document.querySelector(`.quantity-input[data-id="${productId}"]`);
            let quantity = parseInt(inputField.value);

            if (e.target.classList.contains('quantity-minus')) {
                quantity = Math.max(0, quantity - 1);
            } else if (e.target.classList.contains('quantity-plus')) {
                quantity = Math.min(3, quantity + 1);
            }

            inputField.value = quantity;
        }
    });

    // Dodanie produktu do bundlera
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('add-to-bundle')) {
            const productId = e.target.getAttribute('data-id');
            const productPrice = parseFloat(e.target.closest('.product-item').getAttribute('data-price'));
            const productName = e.target.closest('.product-item').querySelector('h3').innerText;
            const quantity = parseInt(document.querySelector(`.quantity-input[data-id="${productId}"]`).value);

            if (quantity > 0 && selectedProducts.length + quantity <= 3) {
                for (let i = 0; i < quantity; i++) {
                    selectedProducts.push({ id: productId, price: productPrice, name: productName });
                }

                e.target.classList.add('hidden');
                e.target.nextElementSibling.classList.remove('hidden');
                updateSelectedProducts();
                updateSummary();
            }
        }
    });

    // Usuwanie produktu z bundlera
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-from-bundle')) {
            const productId = e.target.getAttribute('data-id');

            // Usuń wszystkie wystąpienia danego produktu
            while (selectedProducts.find(p => p.id === productId)) {
                const index = selectedProducts.findIndex(p => p.id === productId);
                if (index !== -1) selectedProducts.splice(index, 1);
            }

            e.target.classList.add('hidden');
            e.target.previousElementSibling.classList.remove('hidden');
            updateSelectedProducts();
            updateSummary();
        }

        // Usuwanie z sekcji #selected-products
        if (e.target.classList.contains('remove-from-selected')) {
            const slotIndex = parseInt(e.target.getAttribute('data-slot'));
            const product = selectedProducts[slotIndex];

            if (product) {
                // Usuń produkt ze slotu
                const productId = product.id;
                selectedProducts.splice(slotIndex, 1);

                // Przywróć widoczność przycisku "Add to bundle"
                document.querySelector(`.add-to-bundle[data-id="${productId}"]`).classList.remove('hidden');
                document.querySelector(`.remove-from-bundle[data-id="${productId}"]`).classList.add('hidden');

                updateSelectedProducts();
                updateSummary();
            }
        }
    });

    // Aktualizacja slotów
    function updateSelectedProducts() {
        selectedSlots.forEach((slot, index) => {
            if (selectedProducts[index]) {
                const product = selectedProducts[index];
                const productImage = document.querySelector(`.product-item[data-id="${product.id}"] img`).src;
                console.log(product);
                slot.innerHTML = `
                   <div class="placeholder-selected">
                    <img src="${productImage}" alt="${product.name}">
                    <div class="info">
                    <h4>${product.name}</h4>
                    <p>${product.price.toFixed(2)} zł</p>
                    </div>
                    <button class="remove-from-selected" data-slot="${index}">X</button>
                    </div>
                `;
            } else {
                slot.innerHTML = `
                    <div class="placeholder">
                    <span class="img"></span>
                    <span class="title">Select a product</span>
                    </div>
                `;
            }
        });
    }

    function updateSummary() {
        const originalPrice = selectedProducts.reduce((sum, product) => sum + product.price, 0);
        const discount = originalPrice * 0.15; // Oblicz rabat (15%)
        const discountedPrice = originalPrice - discount; // Cena po rabacie
    
        // Zaktualizuj elementy tekstowe
        discountedPriceElement.textContent = ` ${discountedPrice.toFixed(2)} zł`;
    
        // Wyświetl zaoszczędzoną kwotę
        const savedAmountElement = document.getElementById('saved-amount');
        if (savedAmountElement) {
            savedAmountElement.textContent = `${discount.toFixed(2)} zł`;
        }
    
        // Zarządzanie przyciskiem "Przejdź do zamówienia"
        if (selectedProducts.length === 3) {
            checkoutButton.disabled = false;
            checkoutButton.style.opacity = '1';
            checkoutButton.style.pointerEvents = 'auto';
        } else {
            checkoutButton.disabled = true;
            checkoutButton.style.opacity = '0.5';
            checkoutButton.style.pointerEvents = 'none';
        }
    }
    

    // Go to checkout
    checkoutButton.addEventListener('click', async () => {
        if (selectedProducts.length > 0) {
            const productsToAdd = selectedProducts.map(product => product.id);

            console.log('Wysyłam produkty:', productsToAdd);

            try {
                const response = await fetch('https://bini.jffrbblxkx.cfolks.pl/wp-json/custom-bundler/v1/add-to-cart', {
                    // const response = await fetch('http://localhost/bini/wp-json/custom-bundler/v1/add-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ products: productsToAdd }),
                });
                

                console.log('Odpowiedź serwera:', response);

                const result = await response.json();

                console.log('Wynik JSON:', result);

                if (result.success) {
                    window.location.href = '/bini/zamowienie/';
                    const language = window.location.pathname.split('/')[2]; 
                    console.log(language);
                    if (language === 'en') {
                        window.location.href = '/bini/en/checkout/';
                        
                    } else { 
                        window.location.href = '/bini/zamowienie/';
                    }
                } else {
                    console.error('Błąd podczas dodawania do koszyka:', result.message);
                    alert('Nie udało się dodać produktów do koszyka.');
                }
            } catch (error) {
                console.error('Błąd podczas dodawania do koszyka:', error);
                alert('Wystąpił problem z połączeniem.');
            }
        }
    });




    checkoutButton.addEventListener('click', async () => {
        if (selectedProducts.length > 0) {
            checkoutButton.classList.add('loading'); // Dodaj loader
            checkoutButton.textContent = 'Przetwarzanie...'; // Zmień tekst
            try {
                // Reszta kodu...
            } finally {
                checkoutButton.classList.remove('loading'); // Usuń loader po zakończeniu
                checkoutButton.textContent = 'Przejdź do zamówienia'; // Przywróć tekst
            }
        }
    });
    
    
});


