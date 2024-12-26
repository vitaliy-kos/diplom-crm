const settings = document.querySelector('.settings-page');
const tokenInp = document.querySelector("input[name='token']");

if (settings) {
    const token = tokenInp.value;

    const settings_inputs = settings.querySelectorAll("input[name].autosave");
    settings_inputs.forEach(input => {
        input.addEventListener('input', (event) => {
            
            const key = input.name;
            let val = null;

            if (input.type == 'checkbox') {
                val = input.checked ? 1 : 0;
            } else {
                val = input.value;
            }
            
            $.ajax({
                url: '/api/v1/app/setting',
                type: 'PATCH',
                async: true,
                data: {
                    key: key,
                    value: val
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", token);
                    input.parentElement.classList.add('loading')
                },
                success: function(response) {
                    console.log(response);
                },
                complete: function() {
                    input.parentElement.classList.remove('loading');
                },
            });

        });
    });

    // const tab_links = settings.querySelectorAll('.nav-link');
    // tab_links.forEach(el => {
    //     el.addEventListener('click', (event) => {
    //         cur_tabs_inp.value = event.target.id.slice(0, -4);
    //     });
    // });

    const check_buttons = settings.querySelectorAll('.check_button');
    check_buttons.forEach(check_button => {
        check_button.addEventListener('click', (event) => {
            check_button.disabled = 'disabled';
            check_button.classList.add('loading');

            const service = check_button.dataset.class;

            $.ajax({
                url: '/api/v1/app/check-connection',
                type: 'GET',
                async: true,
                data: {
                    class: service
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", token);
                    const last_res = document.querySelector('.check_block .check_result');
                    if (last_res) last_res.remove();  
                },
                success: function(data) {
                    const response = JSON.parse(data);
                    
                    if (response.status == 'ok') {
                        check_button.insertAdjacentHTML('afterend', '<span class="check_result ml-3 text-green">Проверка успешно пройдена.</span>');
                        const next = check_button.parentElement.nextElementSibling;
                        if (next && next.classList.contains('success')) {
                            next.classList.remove('d-none');
                            next.classList.add('d-flex');
                        }
                    } else {
                        check_button.insertAdjacentHTML('afterend', `<span class="check_result ml-3 text-red">Проверка не пройдена. ${response.error}</span>`);
                    }
                    
                },
                error: function(errorThrown) {
                    check_button.insertAdjacentHTML('afterend', '<span class="check_result text-red">Ошибка при отправке запроса!</span>');
                },
                complete: function() {
                    check_button.classList.remove('loading');
                    check_button.disabled = '';
                },
            });

        });
    });




}