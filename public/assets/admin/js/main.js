const fetcher = new Fetcher();

function confirmPopup(
    {
        callbackCancel = () => {
        },
        callbackAction = () => {
        },
        title = 'Xác nhận!',
        content = 'Bạn có chắc chắn với hành động này!',
        type = 'white'
    }
) {
    $.confirm({
        title,
        content,
        type,
        typeAnimated: true,
        animation: 'zoom',
        closeAnimation: 'scale',
        draggable: true,
        buttons: {
            cancel: {
                text: 'Hủy',
                btnClass: 'btn btn-outline-danger',
                action: callbackCancel
            },
            confirm: {
                text: 'Xác nhận',
                btnClass: 'btn-primary',
                action: callbackAction
            }
        }
    })
}

function displayErrors(errors) {
    $('.text-danger').remove();
    $('.is-invalid').removeClass('is-invalid');
    for (const key in errors) {
        if (key.includes('requirments')) {
            const input = $(`.flex-between`)
                .addClass('is-invalid')
            if (input.next('.text-danger').length === 0) {
                const errorElement = $('<div class="text-danger">' + errors[key][0] + '</div>');
                input.after(errorElement)
            } else {
                input.next('.text-danger').text(errors[key][0]);
            }
        }
        const input = $(`#${key}`)
            .addClass('is-invalid')
        if (input.next('.text-danger').length === 0) {
            const errorElement = $('<div class="text-danger">' + errors[key][0] + '</div>');
            input.after(errorElement)
        } else {
            input.next('.text-danger').text(errors[key][0]);
        }
    }
}

function alertSuccess(message = 'Đã thực hiện tác vụ thành công!', callback = null) {
    $.confirm({
        title: 'Thành công!',
        content: message,
        type: 'green',
        typeAnimated: true,
        buttons: {
            close: {
                text: 'Đóng',
                action: callback
            }
        }
    });
}

function replaceUrl(key, value) {
    const urlParams = new URLSearchParams(window.location.search);
    if (value) {
        urlParams.set(key, value);
    } else {
        urlParams.delete(key);
    }
    urlParams.set('page', "1");
    window.location.href = window.location.pathname + '?' + urlParams.toString();
}

function handleDelete(id, action) {
    const itemIds = id;
    confirmPopup({
        callbackAction: () => {
            fetcher.delete(action, {itemIds}, {
                success: function (response) {
                    alertSuccess(response.message, () => {
                        window.location.reload()
                    });
                },
                error: function (error) {
                    console.log('error', error)
                }
            })
        }
    })
}
