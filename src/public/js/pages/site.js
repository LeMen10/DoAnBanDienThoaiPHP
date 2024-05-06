var searchBox, suggestionBox;
var icon, menuOption, logged_dropdown;
$(document).ready(() => {
    logged_dropdown = document.querySelector('.logged-dropdown-wrap');
    menuOption = document.querySelector('.hm-wishlist');
    if (menuOption == null) {
        return;
    }

    searchBox = document.getElementById('searchInput');
    suggestionBox = document.getElementById('suggestionBox');
    document.querySelector('.li-btn').addEventListener('click', function (event) {
        navigateShopPage(event);
    });
    searchBox.addEventListener('input', function () {
        var inputValue = searchBox.value.trim();
        if (inputValue === '') {
            suggestionBox.innerHTML = '';
            suggestionBox.classList.remove('border-1px-solid');
            return;
        }
        loadSuggestion();
    });
    searchBox.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            navigateShopPage(event);
        }
    });

    loadName();
});
function loadName() {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=home&act=getUserName',
        dataType: 'json',

        success: res => {
            if (!res.user) return;
            const actionLogged = document.querySelector('.header-action-logged');
            const priceCart = document.querySelector('.item-text');
            actionLogged.innerHTML = `<div class="logged-dropdown-wrap">
                <ul class="logged-dropdown-list">
                    <li class="logged-dropdown-item js-order-history">
                        <a class="logged-dropdown-item-content" href='index.php?ctrl=purchase_order'>
                            <i class="fa-solid fa-cart-shopping"></i>
                            <p >Purchase</p>
                        </a>
                    </li>
                    <li class="logged-dropdown-item">
                        <a class="logged-dropdown-item-content">
                            <i class="fa-solid fa-right-from-bracket icon-logout"></i>
                            <p class='log_out' onClick = 'logOut()'>Log Out</p>
                        </a>
                    </li>
                </ul>
            </div>`;
            var avatar = document.getElementById('avatar');
            var name_split = res.user['name'].toUpperCase();
            avatar.textContent = name_split[0];
            priceCart.innerHTML = `${res.cart['price']} <span class='cart-item-count'>${res.cart['quantity']}</span>`;
        },
        error: err => {
            console.log(err);
        },
    });
}
function logOut() {
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=home&act=logout',
        success: res => {
            window.location.href = 'index.php?ctrl=login';
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
}
function formLogIn() {
    window.location.href = 'index.php?ctrl=login';
}

function changeParamInUrl(param, paramValue, url) {
    if (paramValue !== '') {
        if (url.includes(param)) {
            const arrCurUrlAfterSpliting = url.split('&');
            const newArrCurUrl = arrCurUrlAfterSpliting
                .map(value => {
                    if (value.includes(`${param}=`)) {
                        const newValue = `${param}=` + paramValue;
                        return newValue;
                    }
                    return value;
                })
                .join('&');
            window.location.href = newArrCurUrl;
        } else {
            window.location.href = url + `&${param}=` + paramValue;
        }
    }
}
function navigateShopPage(event) {
    event.preventDefault()
    var inputValue = searchBox.value.trim();
    if (inputValue != '') {
        window.location.href = 'index.php?ctrl=shop&search=' + searchBox.value;
    }
}
function loadSuggestion() {
    stringFind = searchBox.value;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=home&act=GetSuggestion',
        data: { stringFind },
        dataType: 'json',
        success: res => {
            suggestionBox.setAttribute('class', 'border-1px-solid');
            suggestionBox.innerHTML = '';
            res.suggest.forEach(item => {
                var suggestionItem = document.createElement('div');
                suggestionItem.textContent = item['name'];
                suggestionItem.addEventListener('click', function () {
                    searchBox.value = suggestionItem.textContent;
                    suggestionBox.innerHTML = '';
                    searchBox.focus();
                    suggestionBox.classList.remove('border-1px-solid');
                });
                suggestionBox.appendChild(suggestionItem);
            });
        },
        error: err => {
            console.log(err);
        },
    });
}
