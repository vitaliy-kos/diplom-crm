const sparePartsBlock = document.querySelector('.spare-parts');
const sparePartsTable = document.querySelector('.table-spare-parts');
const orderIdInp = document.querySelector("input[name='order_id']");
const tokenInp = document.querySelector("input[name='token']");
const spareRartsSendedInp = document.querySelector("input[name='spare_parts_sended']");

if (sparePartsTable) {
    let spare_parts;
    const spareRartsSended = spareRartsSendedInp.value == true;
    const orderId = orderIdInp.value;
    const token = tokenInp.value;
    const addBtn = sparePartsTable.querySelector('.add_spare_part');
    const tBody = sparePartsTable.querySelector('tbody');

    const gotMoneyInput = sparePartsBlock.querySelector('.got_money');
    const sendSparePartBtn = sparePartsBlock.querySelector('.send_spare_parts');
    
    sendSparePartBtn.addEventListener('click', function (e) {
        if (e.target.classList.contains('disabled')) {
            return false;
        } else if (!isNotEmptyMoneyGot()) {
            alert('Не указана сумма полученная от клиента!');
            return false;
        } else if (!isAllSparePartsFilled()) {
            alert('Имеются незаполненные поля в запчастях!');
            return false;
        } else {
            let sumOfParts = 0;
            const sumOfPartsInputs = tBody.querySelectorAll('.result .value');
            sumOfPartsInputs.forEach(cost => {
                sumOfParts += parseFloat(cost.innerText);
            });

            $.ajax({
                url: `/api/v1/app/order-meta/${orderId}/cost_of_parts`,
                type: 'PATCH',
                async: false,
                data: {
                    value: sumOfParts
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", token);
                },
                success: function(response) {
                        
                }
            });

            $.ajax({
                url: `/api/v1/app/order-meta/${orderId}/spare_parts_sended`,
                type: 'PATCH',
                async: true,
                data: {
                    value: true
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", token);
                },
                success: function(response) {
                    if (response.status == 200) {
                        window.location.reload();
                    }
                }
            });
            
        }
        
    });

    function isAllSparePartsFilled() {
        let filled = true;
        const rows = tBody.querySelectorAll(`tr.data_row`);
        rows.forEach(row => {
            const price_val = row.querySelector("input[name='price']").value;
            const count_val = row.querySelector("input[name='count']").value;
            const spare_part_sel = row.querySelector(".choose_spare_part");
            const sparePartObj = getChoiceObject(spare_part_sel);

            if (sparePartObj.getValue().value == '' ) filled = false;
            if (price_val <= 0) filled = false;
            if (count_val <= 0) filled = false;
        });
        
        return filled;
    }

    function isNotEmptyMoneyGot() {
        return parseInt(gotMoneyInput.value) > 0;
    };

    gotMoneyInput.addEventListener('beforeinput', checkNumbers);
    gotMoneyInput.addEventListener('input', function (e) {
        $.ajax({
            url: `/api/v1/app/order-meta/${orderId}/got_money`,
            type: 'PATCH',
            async: true,
            data: {
                value: gotMoneyInput.value
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", token);
            },
            success: function(response) {
            }
        });
    });


    addBtn.addEventListener('click', function (e) {
        $.ajax({
            url: `/api/v1/app/order-spare-parts/${orderId}`,
            type: 'POST',
            async: false,
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", token);
            },
            success: function(response) {
                if (tBody.querySelector('tr') && tBody.querySelector('tr').classList.contains('empty')) {
                    tBody.innerHTML = '';
                }
                printSparePartRow(response.data);
            }
        });
    });

    $.ajax({
        url: `/api/v1/app/spare-parts`,
        type: 'GET',
        async: false,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", token);
        },
        success: function(response) {
            spare_parts = response.data;
            spare_parts.map(spare_part => {
                renameProp(spare_part, 'name', 'label');
                renameProp(spare_part, 'id', 'value');
            });
            spare_parts.map(spare_part => {
                spare_part.label = `${spare_part.label} | ${spare_part.category}`
            });
        }
    });
    
    $.ajax({
        url: `/api/v1/app/order-spare-parts/${orderId}`,
        type: 'GET',
        async: true,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", token);
        },
        success: function(response) {
            if (response.data.length > 0) {
                printTable(response.data);
            } else {
                tBody.insertAdjacentHTML('afterbegin', '<tr class="empty"><td colspan="5" class="text-center">Запчасти не добавлены</td></tr>');
            }
        },
        complete: function(params) {
            tBody.querySelector('.loader').remove();
        }
    });

    function printTable(rowsData) {
        rowsData.forEach(spare_part => {
            printSparePartRow(spare_part);
        });
    }
    
    function printSparePartRow(spare_part) {
        const row_main = createRowMain(spare_part);
        const row_comment = createRowComment(spare_part);
    
        tBody.appendChild(row_main);
        tBody.appendChild(row_comment);
        initSelects();
    }

    function createRowMain(spare_part){
        const row = document.createElement('tr');
        row.dataset.id = spare_part.id;
        row.classList.add('data_row');

            const tdService = document.createElement('td');
            tdService.classList.add('text-center');
            const selectElem = select('', '', 'Выберите запчасть', spare_parts, 'choose_spare_part', spare_part.spare_part_id);
            selectElem.addEventListener('change', updateSparePart);
            if (spareRartsSended) selectElem.disabled = 'disabled';
            tdService.insertAdjacentElement('afterbegin', selectElem);
            row.appendChild(tdService);

            const tdSum = document.createElement('td');
            tdSum.classList.add('text-center');
                const inpSum = document.createElement('input');
                inpSum.type = 'number';
                inpSum.name = 'price';
                inpSum.classList.add('form-control');
                inpSum.value = spare_part.price ?? '';
                inpSum.placeholder = 'Стоимость детали';
                if (spareRartsSended) inpSum.disabled = 'disabled';
                inpSum.addEventListener('input', updateSparePart);
                inpSum.addEventListener('beforeinput', checkNumbers);
                tdSum.appendChild(inpSum);
            row.appendChild(tdSum);
            
            const tdPercent = document.createElement('td');
            tdPercent.classList.add('text-center');
                const inpPercent = document.createElement('input');
                inpPercent.type = 'number';
                inpPercent.name = 'count';
                inpPercent.min = 0;
                inpPercent.max = 100;
                inpPercent.classList.add('form-control');
                inpPercent.value = spare_part.quantity ?? 1;
                inpPercent.placeholder = 'Количество';
                if (spareRartsSended) inpPercent.disabled = 'disabled';
                inpPercent.addEventListener('input', updateSparePart);
                inpPercent.addEventListener('beforeinput', checkNumbers);
                tdPercent.appendChild(inpPercent);
            row.appendChild(tdPercent);

            const tdProfit = document.createElement('td');
            tdProfit.classList.add('text-center');
            tdProfit.innerHTML = `<div class="result" name="result"><span class="value">${spare_part.result ?? 0}</span> ₽</div>`;
            row.appendChild(tdProfit);

            const tdDelete = document.createElement('td');
            tdDelete.classList.add('text-center', 'removetd');
                if (!spareRartsSended) {
                    const removeBtn = document.createElement('button');
                    removeBtn.dataset.id = spare_part.id;
                    removeBtn.classList.add('btn', 'btn-outline-danger', 'sml-btn', 'btn');
                    removeBtn.addEventListener('click', removeService);
                    removeBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>`;
                    tdDelete.appendChild(removeBtn);
                }
                
            row.appendChild(tdDelete);

        return row;
    }

    function createRowComment(spare_part){
        const row = document.createElement('tr');
        row.dataset.id = spare_part.id;
        const td = document.createElement('td');

            td.colSpan = 5;
                const textarea = document.createElement('textarea');
                textarea.classList.add('form-control');
                textarea.name = 'comment';
                textarea.rows = 2;
                textarea.placeholder = 'Комментарий';
                textarea.value = spare_part.comment ?? '';
                if (spareRartsSended) textarea.disabled = 'disabled';
                textarea.addEventListener('input', updateSparePart);
                td.appendChild(textarea);
            row.appendChild(td);

        return row;
    }

    function removeService() {
        const sparePartId = this.dataset.id;

        $.ajax({
            url: `/api/v1/app/order-spare-parts/${orderId}/${sparePartId}`,
            type: 'DELETE',
            async: true,
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", token);
            },
            success: function(response) {
                if (response.status == 204) {
                    sparePartsTable.querySelectorAll(`tr[data-id='${sparePartId}']`).forEach(row => {
                        row.remove();
                    });
                }
            }
        });
    }

    function countResultSum(row_main, price_val, count_val) {
        const result_val = row_main.querySelector(".result .value");

        if (parseInt(price_val) > 0 && parseInt(count_val) > 0) {
            result_val.innerText = price_val * count_val;
        } else {
            result_val.innerText = 0;
        }
    }

    function checkNumbers(event) {
        const regex = new RegExp("^[0-9]*$");
        if (event.data != null && !regex.test(event.data)) {
            event.preventDefault();
        }
        
        if (event.target.name == 'count' && parseInt(event.target.value + event.data) > 100) 
            event.preventDefault();

        if (event.target.name == 'sum' && parseInt(event.target.value + event.data) > 1000000) 
            event.preventDefault();
    }
    
    function updateSparePart(e) {

        let mainRow;
        let spare_part_obj;

        if (e.target.classList.contains('choose_spare_part')) {
            mainRow = e.target.parentElement.parentElement.parentElement.parentElement;
        } else {
            mainRow = e.target.parentElement.parentElement;
        }
        
        const sparePartId = mainRow.dataset.id;
        const row_main = sparePartsTable.querySelectorAll(`tr[data-id='${sparePartId}']`)[0];
        const row_comment = sparePartsTable.querySelectorAll(`tr[data-id='${sparePartId}']`)[1];

        const comment_val = row_comment.querySelector("textarea[name='comment']").value;
        const price_val = row_main.querySelector("input[name='price']").value;
        const count_val = row_main.querySelector("input[name='count']").value;

        countResultSum(row_main, price_val, count_val);

        const result_val = row_main.querySelector(".result .value").innerText;

        let spare_part_val = null;
        const spare_part = row_main.querySelector(".choose_spare_part");
        
        if (spare_part) {
            spare_part_obj = getChoiceObject(spare_part);
            if (spare_part_obj.getValue()) spare_part_val = spare_part_obj.getValue().value;
        }
        
        $.ajax({
            url: `/api/v1/app/order-spare-parts/${orderId}/${sparePartId}`,
            type: 'PATCH',
            async: true,
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", token);
            },
            data: {
                spare_part_id: spare_part_val,
                comment: comment_val,
                price: price_val,
                quantity: count_val,
                result: result_val,
            },
            success: function(response) {
                
            }
        });
    }

    
    
}