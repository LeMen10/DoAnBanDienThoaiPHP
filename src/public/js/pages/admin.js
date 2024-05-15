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
    loadChart();
    selectedSiderbar();
});

const loadChart = () => {
    getProfits()
    .then(response => {
        const { data, paymentDay, paymentYear, quantityDay, quantityYear } = response;
        if (data != null && Array.isArray(data)) {
            const months = data.map(item => `Tháng ${item.thang}`);
            const revenues = data.map(item => item.tongTien);
            document.getElementById("quantityDay").innerHTML = quantityDay;
            document.getElementById("quantityYear").innerHTML = quantityYear;
            document.getElementById("paymentDay").innerHTML = paymentDay;
            document.getElementById("paymentYear").innerHTML = paymentYear;
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Doanh thu',
                            data: revenues,
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
        } else {
            console.error("Data format is incorrect or data is null");
        }
    })
    .catch(error => {
        console.log(error);
    });
}

const getProfits = () => {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'get',
            url: 'index.php?ctrl=admin&act=getStatisticOrder',
            data: {},
            dataType: 'json',
            success: res => {
                if (res.status == 401) return navigationLogin();
                resolve({
                    data: res.data,
                    paymentDay: res.paymentDay,
                    paymentYear: res.paymentYear,
                    quantityDay: res.quantityDay,
                    quantityYear: res.quantityYear
                });
            },
            error: err => {
                reject(err);
            },
        });
    });
}


const handleToDateChange = event => {
    const currentDateString = new Date().toISOString().slice(0, 10);
    const inputDateString = event.target.value;
    const currentDate = new Date(currentDateString);
    const inputDate = new Date(inputDateString);
    if (inputDate.getTime() - currentDate.getTime() > 0) 
        return toast({
            title: 'Thông báo!',
            message: 'Ngày được chọn không hợp lệ 😐',
            type: 'warning',
            duration: 2000,
        });
    else toDate = inputDateString.concat(' ', '23:59:59');
    if (toDate != '' && since != '') getSellingProducts();
};

const handleSinceChange = event => {
    const currentDateString = new Date().toISOString().slice(0, 10);
    const inputDateString = event.target.value;
    const currentDate = new Date(currentDateString);
    const inputDate = new Date(inputDateString);
    if (inputDate.getTime() - currentDate.getTime() > 0) 
        return toast({
            title: 'Thông báo!',
            message: 'Ngày được chọn không hợp lệ 😐',
            type: 'warning',
            duration: 2000,
        });
    else since = inputDateString.concat(' ', '00:00:00');
    if (toDate != '' && since != '') getSellingProducts();
};

const getSellingProducts = () => {
    const body = document.querySelector('.selling-product');
    let html = '';
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=admin&act=getSellingProducts',
        data: { since, toDate },
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            if(res.status == 403) return navigation403();
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
    if (inputDate.getTime() - currentDate.getTime() > 0)
        return toast({
            title: 'Thông báo!',
            message: 'Ngày được chọn không hợp lệ 😐',
            type: 'warning',
            duration: 2000,
        });
    else toDateBusiness = inputDateString.concat(' ', '23:59:59');
    if (toDateBusiness != '' && sinceBusiness != '') getBusinessSituation();
};

const handleSinceBusinessChange = event => {
    const currentDateString = new Date().toISOString().slice(0, 10);
    const inputDateString = event.target.value;
    const currentDate = new Date(currentDateString);
    const inputDate = new Date(inputDateString);
    if (inputDate.getTime() - currentDate.getTime() > 0) 
        return toast({
            title: 'Thông báo!',
            message: 'Ngày được chọn không hợp lệ 😐',
            type: 'warning',
            duration: 2000,
        });
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
            if(res.status == 401) return navigationLogin();
            if(res.status == 403) return navigation403();
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

const navigation403 = () => { window.location.href = 'index.php?ctrl=myerror&act=forbidden' }

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

