$(document).ready(() => {

})
let arrID = [];

const editRole = (id) => {
    const tag = document.querySelector('.check-edit');
    tag.classList.add('d-flex')
    console.log(1)
    getFeature(id);
}

const getFeature = (id) => {
    const features = document.querySelector('.features');
    let html = '';
    arrID = [];
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=role&act=getFeature',
        data: {id},
        dataType: 'json',
        success: res => {
            console.log(res.feature)
            if(res.status == 401) return navigationLogin();
            res.feature.forEach((item, i) => {
                if (item.show == 1 || item.edit == 1) arrID.push({ a:item.authorID, f: item.featureID, s: item.show, e: item.edit});
                html += 
                    `<tr class='product-item'>
                        <td>${Number(i)}</td>
                        <td>${item.name}</td>
                        <td><input data-id=${item.featureID} name="show" onchange="updateShowArr(${item.featureID})" type="checkbox" ${item.show == 1 ? "checked" : ''} ${item.disable == 0 ? "disabled" : ''}/></td>
                        <td><input data-id=${item.featureID} name="edit" onchange="updateEditArr(${item.featureID})" type="checkbox" ${item.edit == 1 ? "checked" : ''} ${item.disable == 0 ? "disabled" : ''}/></td>
                    </tr>`;
            })
            
            features.innerHTML = html;
        },
        error: err => {
            console.log(err)
        },
    });
}

const updateEditArr = (id) => {
    const tag = document.querySelector(`input[data-id="${id}"][name="edit"]`);
    for (let i = 0; i < arrID.length; i++) {
        if (arrID[i].f === `${id}` && tag.checked == false) delete arrID[i].e;
        if (arrID[i].f === `${id}` && tag.checked == true) arrID[i].e = '1';
    }
}

const updateShowArr = (id) => {
    const tag = document.querySelector(`input[data-id="${id}"][name="show"]`);
    for (let i = 0; i < arrID.length; i++) {
        if (arrID[i].f === `${id}` && tag.checked == false) delete arrID[i].s;
        if (arrID[i].f === `${id}` && tag.checked == true) arrID[i].s = '1';
    }
}

const saveRole = () => {
    console.log(arrID )
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=role&act=saveRole',
        data: {arrID},
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            console.log(res)
            const tag = document.querySelector('.check-edit');
            tag.classList.remove('d-flex')
        },
        error: err => {
            console.log(err)
        },
    });
}

const backModal = () => {
    const tag = document.querySelector('.check-edit');
    tag.classList.remove('d-flex')
}