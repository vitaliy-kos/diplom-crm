const recordings = document.querySelectorAll('.audio');

if (recordings) {
    recordings.forEach(recording => {
        const unique = recording.dataset.unique;
        
        $.ajax({
            url: `/api/v1/app/call-recording/`,
            type: 'POST',
            async: true,
            data: {
                unique: unique
            },
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", token);
            },
            success: function(response) {
                recording.querySelector('.loader-audio').remove();
                recording.insertAdjacentHTML('afterbegin', `<br><audio src="${response.data.link}" controls></audio>`);
            },
            error: function(errorThrown) {
                recording.querySelector('.loader-audio').remove();
                recording.insertAdjacentHTML('afterbegin', '<p>Произошла ошибка при загрузки этого блока. Обратитесь к администратору.</p>');
            }
        });
    });
}