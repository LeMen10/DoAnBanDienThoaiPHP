let toDate = '',
    since = '',
    toDateBusiness = '',
    sinceBusiness = '', cate = [];
$(document).ready(() => {
    const toDateInput = document.getElementById('to-date');
    toDateInput.addEventListener('change', handleToDateChange);

    const sinceInput = document.getElementById('since');
    sinceInput.addEventListener('change', handleSinceChange);

    const toDateBusinessInput = document.getElementById('since-business');
    toDateBusinessInput.addEventListener('change', handleSinceBusinessChange);

    const sinceBusinessInput = document.getElementById('to-date-business');
    sinceBusinessInput.addEventListener('change', handleToDateBusinessChange);

    const months = [
        'Tháng 1',
        'Tháng 2',
        'Tháng 3',
        'Tháng 4',
    ];

    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'revenue',
                    data: [12, 19, 0, 5],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });


});

const handleToDateChange = event => {
    const currentDateString = new Date().toISOString().slice(0, 10);
    const inputDateString = event.target.value;
    const currentDate = new Date(currentDateString);
    const inputDate = new Date(inputDateString);
    if (inputDate.getTime() - currentDate.getTime() > 0) console.log(0);
    else toDate = inputDateString.concat(' ', '23:59:59');
    if (toDate != '' && since != '') getSellingProducts();
};

const handleSinceChange = event => {
    const currentDateString = new Date().toISOString().slice(0, 10);
    const inputDateString = event.target.value;
    const currentDate = new Date(currentDateString);
    const inputDate = new Date(inputDateString);
    if (inputDate.getTime() - currentDate.getTime() > 0) console.log(0);
    else since = inputDateString.concat(' ', '00:00:00');
    if (toDate != '' && since != '') getSellingProducts();
};

const getSellingProducts = () => {
    const body = document.querySelector('.selling-product');
    let html = '';
    console.log(toDate, since);
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=admin&act=getSellingProducts',
        data: { since, toDate },
        dataType: 'json',
        success: res => {
            console.log(res);
            if(res.status == 401) return navigationLogin();
            res.data.map(item => {
                html += `<tr>
                            <td><img src="public/img/phone_image/${item.image}" alt=""></td>
                            <td>${item.name}</td>
                            <td><span>đ</span>${item.price}</td>
                            <td>${item.total_sold}</td>
                        </tr>`;
            });
            body.innerHTML = html;
        },
        error: err => {
            console.log('Error Status:', err);
        },
    });
};

const handleToDateBusinessChange = event => {
    const currentDateString = new Date().toISOString().slice(0, 10);
    const inputDateString = event.target.value;
    const currentDate = new Date(currentDateString);
    const inputDate = new Date(inputDateString);
    if (inputDate.getTime() - currentDate.getTime() > 0) console.log(0);
    else toDateBusiness = inputDateString.concat(' ', '23:59:59');
    if (toDateBusiness != '' && sinceBusiness != '') getBusinessSituation();
};

const handleSinceBusinessChange = event => {
    const currentDateString = new Date().toISOString().slice(0, 10);
    const inputDateString = event.target.value;
    const currentDate = new Date(currentDateString);
    const inputDate = new Date(inputDateString);
    if (inputDate.getTime() - currentDate.getTime() > 0) console.log(0);
    else sinceBusiness = inputDateString.concat(' ', '00:00:00');
    if (toDateBusiness != '' && sinceBusiness != '') getBusinessSituation();
};

const getBusinessSituation = () => {
    const body = document.querySelector('.body-business-situation');
    let html = '';
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=admin&act=getBusinessSituation',
        data: { sinceBusiness, toDateBusiness },
        dataType: 'json',
        success: res => {
            console.log(res);
            if(res.status == 401) return navigationLogin();
            res.data.map(item => {
                html += `<tr>
                            <td>${item.name}</td>
                            <td>${item.total_quantity}</td>
                            <td><span>đ</span>${item.total_price}</td>
                        </tr>`;
            });
            body.innerHTML = html;
        },
        error: err => {
            console.log('Error Status:', err);
        },
    });
};

const navigationLogin = () => { window.location.href = 'index.php?ctrl=login' };