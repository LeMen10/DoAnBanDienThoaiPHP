var elementPhoneID, elementSizeID, elementColorID, quantityInput;
var slides, images;
var currentSlide = 0,
    totalSlides = 0;
$(document).ready(() => {
    elementPhoneID = document.querySelector(`.product-desc`);
    elementSizeID = document.getElementById('sizeSelect');
    elementColorID = document.getElementById('colorSelect');
    quantityInput = document.querySelector('.cart-plus-minus-box');
    slides = document.querySelectorAll('.lg-image');
    images = document.querySelectorAll('.sm-image');
    totalSlides = slides.length;
    document.getElementById('sizeSelect').addEventListener('change', handleSizeChange);
    document.getElementById('colorSelect').addEventListener('change', handleColorChange);
    document.getElementById('moreInfoBtn').addEventListener('click', handleMoreInformation);
    document.querySelector('.dec').addEventListener('click', handleDecreaseQuantity);
    document.querySelector('.inc').addEventListener('click', handleIncreaseQuantity);
    document.querySelector('.add-to-cart').addEventListener('click', function (event) {
        event.preventDefault();
        handleAddCart();
    });
    addEventQuantityInput();
    // Thiết lập slider tự động
    slides[currentSlide].classList.add('active');
    setInterval(nextSlide, 10000);
    const overlay = document.querySelector('.overlay');
    overlay.style.width = 100 / totalSlides + '%';
    document.getElementById('prevBtn').addEventListener('click', function () {
        prevSlide();
    });
    document.getElementById('nextBtn').addEventListener('click', function () {
        nextSlide();
    });

    document.querySelector('.buy-now').addEventListener('click', () => buyNow());
});

function addEventQuantityInput() {
    quantityInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            handleEnterKeyPress();
        }
    });
    quantityInput.addEventListener('blur', handleEnterKeyPress);
}

function handleMoreInformation() {
    var productDesc = document.querySelector('.product-desc');
    var moreInfoBtn = document.getElementById('moreInfoBtn');
    if (moreInfoBtn.textContent === 'Xem thêm') {
        productDesc.style.maxHeight = 'none';
        moreInfoBtn.textContent = 'Ẩn bớt';
    } else {
        productDesc.style.maxHeight = '9em';
        moreInfoBtn.textContent = 'Xem thêm';
    }
}
function handleIncreaseQuantity() {
    loadQuantityProduct()
        .then(quantity => {
            if (parseInt(quantityInput.value) == quantity) return;
            quantityInput.value = parseInt(quantityInput.value) + 1;
        })
        .catch(error => {
            console.log(error);
        });
}
function handleDecreaseQuantity() {
    if (parseInt(quantityInput.value) <= 1) return;
    quantityInput.value = parseInt(quantityInput.value) - 1;
}
function handleEnterKeyPress() {
    loadQuantityProduct()
        .then(quantity => {
            if (isNaN(quantityInput.value) || quantityInput.value.trim() === '') {
                quantityInput.value = quantity == 0 ? 0 : 1;
                return;
            }
            if (parseInt(quantityInput.value) > quantity) {
                quantityInput.value = quantity;
            }
            if (parseInt(quantityInput.value) <= 0) {
                quantityInput.value = quantity == 0 ? 0 : 1;
            }
        })
        .catch(error => {
            console.log(error);
        });
}

const handleSizeChange = () => {
    phoneID = elementPhoneID.getAttribute('data-id');
    sizeID = elementSizeID.value;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=detail&act=getAllColor',
        data: { phoneID, sizeID },
        dataType: 'json',
        success: res => {
            changeVariant(res.variant);
            changeColorSelect(res.colors);
        },
        error: err => {
            console.log(err);
        },
    });
};
const handleColorChange = () => {
    phoneID = elementPhoneID.getAttribute('data-id');
    sizeID = elementSizeID.value;
    colorID = elementColorID.value;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=detail&act=getVariant',
        data: { phoneID, sizeID, colorID },
        dataType: 'json',
        success: res => {
            changeVariant(res.variant);
        },
        error: err => {
            console.log(err);
        },
    });
};
const loadQuantityProduct = () => {
    return new Promise((resolve, reject) => {
        let phoneID = elementPhoneID.getAttribute('data-id');
        let sizeID = elementSizeID.value;
        let colorID = elementColorID.value;
        $.ajax({
            type: 'post',
            url: 'index.php?ctrl=detail&act=getVariant',
            data: { phoneID, sizeID, colorID },
            dataType: 'json',
            success: res => {
                resolve(res.variant['quantity']);
            },
            error: err => {
                reject(err);
            },
        });
    });
};
const changeColorSelect = Colors => {
    var colorSelect = document.getElementById('colorSelect');
    if (colorSelect != null) {
        clearSelect(colorSelect);
        Colors.forEach(color => {
            var option = document.createElement('option');
            option.text = color['color'];
            option.value = color['colorID'];
            colorSelect.appendChild(option);
        });
    }
};

const changeVariant = Variant => {
    const priceElement = document.getElementById('price-value');
    const quantityElement = document.getElementById('quantity-value');
    if (priceElement != null) priceElement.innerHTML = '<span>đ</span>' + Variant['price'];
    if (quantityElement != null) quantityElement.innerHTML = 'Quantity: ' + Variant['quantity'];
};

function clearSelect(selectElement) {
    while (selectElement.options.length > 0) {
        selectElement.remove(0);
    }
}
function handleAddCart() {
    const priceCart = document.querySelector('.item-text');
    const phoneID = elementPhoneID.getAttribute('data-id');
    const sizeID = elementSizeID.value;
    const colorID = elementColorID.value;
    const quantity = quantityInput.value;
    if (quantity == 0) return;
    loadCart(phoneID, sizeID, colorID, quantity)
        .then(cart => {
            if (cart != null) {
                priceCart.innerHTML = `<span class='cart-item-count'>${cart['quantity']}</span>`;
            }
        })
        .catch(error => {
            console.log(error);
        });
}
const loadCart = (phoneID, sizeID, colorID, quantity) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'post',
            url: 'index.php?ctrl=detail&act=addToCart',
            data: { phoneID, sizeID, colorID, quantity},
            dataType: 'json',
            success: res => {
                if(res.status == 401) return navigationLogin();
                if(res.status == 403) return navigation403();
                resolve(res.cart);
            },
            error: err => {
                reject(err);
            },
        });
    });
};

function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % totalSlides;
    slides[currentSlide].classList.add('active');
    moveOverlay();
}
function prevSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    slides[currentSlide].classList.add('active');
    moveOverlay();
}
function moveOverlay() {
    const overlay = document.querySelector('.overlay');
    overlay.style.left = (100 / totalSlides) * currentSlide + '%';
}

const buyNow = () => {
    const phoneID = elementPhoneID.getAttribute('data-id');
    const sizeID = elementSizeID.value;
    const colorID = elementColorID.value;
    const quantity = quantityInput.value;

    checkStock(phoneID, sizeID, colorID)
        .then(stock => {
            console.log(Number(stock))
            if(Number(quantity) > Number(stock)) {
                return toast({
                    title: 'Thông báo!',
                    message: 'Hàng trong kho không đủ 😐',
                    type: 'warning',
                    duration: 2000,
                });
            }
            return $.ajax({
                type: 'post',
                url: 'index.php?ctrl=detail&act=buyNow',
                data: { phoneID, sizeID, colorID, quantity },
                dataType: 'json',
                success: res => {
                    if(res.status == 401) return navigationLogin();
                    if(res.status == 403) return navigation403();
                    localStorage.setItem('cartID', res.cartID);
                    window.location.href = 'index.php?ctrl=cart';
                },
                error: err => {
                    console.log('Error Status:', err.status);
                },
            });
        })
        .catch(error => {
            console.log(error);
        })

    
}

const toast = ({ title = '', message = '', type = 'info', duration = 2000 }) => {
    const main = document.getElementById('toast');
    if (main) {
        const toast = document.createElement('div');
        const autoRemove = setTimeout(function () {
            main.removeChild(toast);
        }, duration + 1000);
        toast.onclick = function (e) {
            if (e.target.closest('.toast__close')) {
                main.removeChild(toast);
                clearTimeout(autoRemove);
            }
        };
        const icons = {
            success: 'fa-solid fa-circle-check',
            info: 'fa-solid fa-circle-info',
            warning: 'fa-solid fa-circle-exclamation',
        };
        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2);
        toast.classList.add('toast', `toast--${type}`);
        toast.style.animation = `slideInleft ease .6s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                <div class="toast__icon">
                    <i class="${icon}"></i>
                </div>
                <div class="toast__body">
                    <h3 class="toast__title">${title}</h3>
                    <p class="toast__msg">${message}</p>
                </div>
                <div class="toast__close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            `;
        main.appendChild(toast);
    }
};

const navigationLogin = () => { window.location.href = 'index.php?ctrl=login' };

const navigation403 = () => { window.location.href = 'index.php?ctrl=myerror&act=forbidden' }

const checkStock = (phoneID, sizeID, colorID) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'get',
            url: 'index.php?ctrl=detail&act=checkStock',
            data: { phoneID, sizeID, colorID},
            dataType: 'json',
            success: res => {
                if(res.status == 401) return navigationLogin();
                resolve(res.stock.quantity);
            },
            error: err => {
                reject(err);
            },
        });
    });
}