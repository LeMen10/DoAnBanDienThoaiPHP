var elementPhoneID, elementSizeID, elementColorID, quantityInput;
$(document).ready(() => {
    elementPhoneID = document.querySelector(`.product-desc`);
    elementSizeID = document.getElementById("sizeSelect");
    elementColorID = document.getElementById("colorSelect");
    quantityInput = document.querySelector(".cart-plus-minus-box");
    document.getElementById("sizeSelect").addEventListener("change", handleSizeChange);
    document.getElementById("colorSelect").addEventListener("change", handleColorChange);
    document.getElementById("moreInfoBtn").addEventListener('click', handleMoreInformation);
    document.querySelector(".dec").addEventListener('click', handleDecreaseQuantity);
    document.querySelector(".inc").addEventListener('click', handleIncreaseQuantity);
    document.querySelector(".add-to-cart").addEventListener('click', function (event) {
        event.preventDefault();
        handleAddCart();
    });
    document.addEventListener("DOMContentLoaded", addSliderEvent);
    addEventQuantityInput();
})

function addEventQuantityInput() {
    quantityInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            handleEnterKeyPress();
        }
    });
    quantityInput.addEventListener('blur', function (event) {
        handleEnterKeyPress();
    });
}

function handleMoreInformation() {
    var productDesc = document.querySelector('.product-desc');
    var moreInfoBtn = document.getElementById('moreInfoBtn');
    if (moreInfoBtn.textContent === 'Xem thêm') {
        productDesc.style.maxHeight = 'none';
        moreInfoBtn.textContent = 'Ẩn bớt';
    } else {
        productDesc.style.maxHeight = '10em';
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
    if (parseInt(quantityInput.value) == 1) return;
    quantityInput.value = parseInt(quantityInput.value) - 1;
}
function handleEnterKeyPress() {
    if (isNaN(quantityInput.value) || quantityInput.value.trim() === '') {
        quantityInput.value = 1;
        return;
    }
    loadQuantityProduct()
        .then(quantity => {
            if (parseInt(quantityInput.value) > quantity) {
                quantityInput.value = quantity;
            }
            if (parseInt(quantityInput.value) <= 0) {
                quantityInput.value = 1;
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
        }
    })
}
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
        }
    })
}
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
                resolve(res.variant["quantity"]);

            },
            error: err => {
                reject(err);
            }
        });
    });
};
const changeColorSelect = (Colors) => {
    var colorSelect = document.getElementById('colorSelect');
    if (colorSelect != null) {
        clearSelect(colorSelect);
        Colors.forEach(color => {
            var option = document.createElement('option');
            option.text = color["color"];
            option.value = color["colorID"];
            colorSelect.appendChild(option);
        });
    }
}

const changeVariant = (Variant) => {
    const priceElement = document.getElementById('price-value');
    const quantityElement = document.getElementById('quantity-value');
    if (priceElement != null) priceElement.innerHTML = "<span>đ</span>" + Variant["price"];
    if (quantityElement != null) quantityElement.innerHTML = "Quantity: " + Variant["quantity"];
}

function clearSelect(selectElement) {
    while (selectElement.options.length > 0) {
        selectElement.remove(0);
    }
}
function handleAddCart()
{
    const priceCart = document.querySelector(".item-text");
    const countCart = document.querySelector(".cart-item-count");
    loadQuantityProduct()
    .then(totalcart => {
       console.log(totalcart);
    })
    .catch(error => {
        console.log(error);
    });
}
const loadCart = () => {
    return new Promise((resolve, reject) => {
        let userID  = 1;
        let phoneID = elementPhoneID.getAttribute('data-id');
        let sizeID = elementSizeID.value;
        let colorID = elementColorID.value;
        let quantity = quantityInput.value;
        $.ajax({
            type: 'post',
            url: 'index.php?ctrl=detail&act=addToCart',
            data: { phoneID, sizeID, colorID, quantity, userID},
            dataType: 'json',
            success: res => {
                resolve(res.totalcart);

            },
            error: err => {
                reject(err);
            }
        });
    });
}

function addSliderEvent() {
    var currentSlide = 0;
    var slides = document.querySelectorAll('.lg-image');
    console.log(slides);
    var totalSlides = slides.length;

    // Hiển thị slide đầu tiên
    slides[currentSlide].classList.add('active');

    // Hàm chuyển đến slide tiếp theo
    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % totalSlides;
        slides[currentSlide].classList.add('active');
    }

    // Hàm chuyển đến slide trước đó
    function prevSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        slides[currentSlide].classList.add('active');
    }

    // Thiết lập slider tự động
    var intervalId = setInterval(nextSlide, 10000);

    // Bắt sự kiện click cho nút Prev
    document.getElementById('prevBtn').addEventListener('click', function () {
        clearInterval(intervalId); // Dừng slider tự động khi người dùng nhấp vào nút
        prevSlide();
    });

    // Bắt sự kiện click cho nút Next
    document.getElementById('nextBtn').addEventListener('click', function () {
        clearInterval(intervalId);
        nextSlide();
    });
}