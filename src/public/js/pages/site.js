var icon;
var searchBox, suggestionBox;
$(document).ready(() => {
    icon = document.querySelector('#avatar');
    searchBox = document.getElementById("searchInput");
    suggestionBox = document.getElementById("suggestionBox");
    document.querySelector('.li-btn').addEventListener("click", function (event) {
        navigateShopPage(event);
    });
    //const id = parseInt(sessionStorage.getItem('token').replace(/"/g,""));
    searchBox.addEventListener("input", function () {
        var inputValue = searchBox.value.trim();
        if (inputValue === "") {
            suggestionBox.innerHTML = "";
            return;
        }
        loadSuggestion();
    });
    searchBox.addEventListener('keydown', function (event) {
        navigateShopPage(event);
    });
    //LoadName(id);
})
function LoadName(id) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=home&act=getUserName',
        data: { id },
        dataType: 'json',
        success: res => {
            var name_split = res.user['name'][0].toUpperCase();
            icon.innerHTML = name_split;

        },
        error: err => {
            console.log(err);
        }

    })

}

function loadSuggestion() {
    stringFind = searchBox.value;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=home&act=GetSuggestion',
        data: { stringFind },
        dataType: 'json',
        success: res => {
            suggestionBox.innerHTML = "";
            res.suggest.forEach(item => {
                var suggestionItem = document.createElement('div');
                suggestionItem.textContent = item['name'];
                suggestionItem.addEventListener('click', function () {
                    searchBox.value = suggestionItem.textContent;
                    suggestionBox.innerHTML = "";
                    searchBox.focus();
                });
                suggestionBox.appendChild(suggestionItem);
            });
        },
        error: err => {
            console.log(err);
        }

    })
}
function navigateShopPage(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        var inputValue = searchBox.value.trim();
        if (inputValue != "") {
            window.location.href = "index.php?ctrl=shop&search=" + searchBox.value;
        }
    }
}