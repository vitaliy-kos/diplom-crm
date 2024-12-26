const servicesTable = document.querySelector('.table-services');
const orderIdInp = document.querySelector("input[name='order_id']");
const tokenInp = document.querySelector("input[name='token']");
const costOfPartsInp = document.querySelector("input[name='cost_of_parts']");
const gotMoneyInp = document.querySelector("input[name='got_money']");

if (servicesTable) {
    let services;
    const orderId = orderIdInp.value;
    const token = tokenInp.value;
    const tBody = servicesTable.querySelector('tbody');

    $.ajax({
        url: `/api/v1/app/service`,
        type: 'GET',
        async: false,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", token);
        },
        success: function(response) {
            services = response.data;
            services.map(service => {
                renameProp(service, 'name', 'label');
                renameProp(service, 'id', 'value');
            });
        }
    });

    function createOneService() {
        $.ajax({
            url: `/api/v1/app/order-services/${orderId}`,
            type: 'POST',
            async: true,
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", token);
            },
            success: function(response) {
                printServiceRow(response.data);
            }
        });
    }
    
    $.ajax({
        url: `/api/v1/app/order-services/${orderId}`,
        type: 'GET',
        async: true,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", token);
        },
        success: function(response) {
            if (response.data.length > 0) {
                printTable(response.data);
            } else {
                createOneService();
            }
        }
    });

    function printTable(rowsData) {
        rowsData.forEach(service => {
            printServiceRow(service);
        });
    }
    
    function printServiceRow(service) {
        const row_main = createRowMain(service);
        const row_comment = createRowComment(service);
    
        tBody.appendChild(row_main);
        tBody.appendChild(row_comment);
        initSelects();
    }

    function createRowMain(service){
        const row = document.createElement('tr');
        row.dataset.id = service.id;

            const tdService = document.createElement('td');
            tdService.classList.add('text-center');
            const selectElem = select('', '', 'Выберите услугу', services, 'choose_service', service.service_id);
            if (service.paid_at) selectElem.disabled = 'disabled';
            selectElem.addEventListener('change', updateService);
            tdService.insertAdjacentElement('afterbegin', selectElem);
            row.appendChild(tdService);

            const tdSum = document.createElement('td');
            tdSum.classList.add('text-center');
            tdSum.innerHTML = `<div class="sum" name="sum"><span class="value">${service.sum_pay ?? gotMoneyInp.value}</span> ₽</div>`;
            row.appendChild(tdSum);

            const tdDiff = document.createElement('td');
            tdDiff.classList.add('text-center');
            tdDiff.innerHTML = `<div class="minus_spare" name="minus_spare"><span class="value">${service.minus_spare ?? gotMoneyInp.value - costOfPartsInp.value}</span> ₽</div>`;
            row.appendChild(tdDiff);
            
            const tdPercent = document.createElement('td');
            tdPercent.classList.add('text-center');
                const inpPercent = document.createElement('input');
                inpPercent.type = 'number';
                inpPercent.name = 'percent';
                inpPercent.min = 0;
                inpPercent.max = 100;
                inpPercent.classList.add('form-control');
                inpPercent.value = service.our_percent ?? '';
                inpPercent.placeholder = 'Процент';
                if (service.paid_at) inpPercent.disabled = 'disabled';
                inpPercent.addEventListener('input', updateService);
                inpPercent.addEventListener('beforeinput', checkNumbers);
                tdPercent.appendChild(inpPercent);
            row.appendChild(tdPercent);

            const tdProfit = document.createElement('td');
            tdProfit.classList.add('text-center');
            tdProfit.innerHTML = `<div class="profit" name="profit"><span class="value">${service.profit ?? 0}</span> ₽</div>`;
            row.appendChild(tdProfit);

            const tdPaid = document.createElement('td');
            tdPaid.classList.add('text-center', 'paid_at');
            tdPaid.innerHTML = service.paid_at ? '<i class="true"></i>' : `<i class="false"></i>`;
                if (!service.paid_at) {
                    const paidBtn = document.createElement('div');
                    paidBtn.classList.add('btn', 'btn-sm', 'btn-success', 'mt-1');
                    paidBtn.innerText = 'Оплачено';
                    if (!service.profit) paidBtn.classList.add('d-none');
                    paidBtn.addEventListener('click', updateService);
                    tdPaid.appendChild(paidBtn);
                }
            row.appendChild(tdPaid);

        return row;
    }

    function createRowComment(service){
        const row = document.createElement('tr');
        row.dataset.id = service.id;
        const td = document.createElement('td');

            td.colSpan = 6;
                const textarea = document.createElement('textarea');
                textarea.classList.add('form-control');
                textarea.name = 'comment';
                textarea.rows = 2;
                textarea.placeholder = 'Комментарий';
                textarea.value = service.comment ?? '';
                if (service.paid_at) textarea.disabled = 'disabled';
                textarea.addEventListener('input', updateService);
                td.appendChild(textarea);
            row.appendChild(td);

        return row;
    }

    function removeService() {
        const serviceId = this.dataset.id;

        $.ajax({
            url: `/api/v1/app/order-services/${orderId}/${serviceId}`,
            type: 'DELETE',
            async: true,
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", token);
            },
            success: function(response) {
                if (response.status == 204) {
                    servicesTable.querySelectorAll(`tr[data-id='${serviceId}']`).forEach(row => {
                        row.remove();
                    });
                }
            }
        });
    }

    function countProfit(row_main, minus_spare_val, percent_val) {
        const profit_val = row_main.querySelector(".profit .value");

        if (parseInt(minus_spare_val) > 0 && parseInt(percent_val) > 0) {
            profit_val.innerText = minus_spare_val * percent_val / 100;
            row_main.querySelector('.paid_at .btn').classList.remove('d-none');
        } else {
            profit_val.innerText = 0;
            row_main.querySelector('.paid_at .btn').classList.add('d-none');
        }
    }

    function checkNumbers(event) {
        const regex = new RegExp("^[0-9]*$");
        if (event.data != null && !regex.test(event.data)) 
            event.preventDefault();
        
        if (event.target.name == 'percent' && parseInt(event.target.value + event.data) > 100) 
            event.preventDefault();
    }
    
    function updateService(e) {

        let mainRow;
        let service_obj;
        let paid = null;

        if (e.target.classList.contains('choose_service')) {
            mainRow = e.target.parentElement.parentElement.parentElement.parentElement;
        } else {
            mainRow = e.target.parentElement.parentElement;
        }
        
        const serviceId = mainRow.dataset.id;
        const row_main = servicesTable.querySelectorAll(`tr[data-id='${serviceId}']`)[0];
        const row_comment = servicesTable.querySelectorAll(`tr[data-id='${serviceId}']`)[1];

        const comment_val = row_comment.querySelector("textarea[name='comment']").value;
        const sum_val = row_main.querySelector(".sum .value").innerText;
        const minus_spare_val = row_main.querySelector(".minus_spare .value").innerText;
        const percent_val = row_main.querySelector("input[name='percent']").value;

        countProfit(row_main, minus_spare_val, percent_val);

        const profit_val = row_main.querySelector(".profit .value").innerText;

        let service_val = null;
        const service = row_main.querySelector(".choose_service");
        if (service) {
            service_obj = getChoiceObject(service);
            if (service_obj.getValue()) service_val = service_obj.getValue().value;
        }
        
        // Проверяем если клик на оплату
        if (e.type == 'click' && e.target.classList.contains('btn')) {
            paid = true;

            if (profit_val == 0) return false;
        }

        $.ajax({
            url: `/api/v1/app/order-services/${orderId}/${serviceId}`,
            type: 'PATCH',
            async: true,
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", token);
            },
            data: {
                service_id: service_val,
                comment: comment_val,
                sum_pay: sum_val,
                minus_spare: minus_spare_val,
                our_percent: percent_val,
                profit: profit_val,
                paid_at: paid, 
            },
            success: function(response) {
                if (paid && response.data.paid_at != null) {
                    row_main.querySelector('td.paid_at').innerHTML = '<i class="true"></i>';
                    
                    service_obj.disable();
                    row_main.querySelector("input[name='percent']").disabled = 'disabled';
                    row_comment.querySelector("textarea[name='comment']").disabled = 'disabled';
                }
            }
        });
    }
}