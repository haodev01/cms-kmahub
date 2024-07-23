new CheckBoxManager({
    selector: '.input-checkbox',
    selectorAll: '.input-checkbox-all',
    buttonDeleteAllSelector: '#button-delete-all',
    titleSelector: '.title-checkbox-selected',
    prefix: 'mục',
});

const callbackAction = (action, data) => {
    fetcher.delete(action, data, {
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
$('.single-delete').click(function () {
    const button = $(this);
    const action = button.data('action');
    confirmPopup({
        callbackAction:
            () => callbackAction(action, {})
    })
})
$('#button-action-delete-all').click(function () {
    const action = $(this).data('action');
    const checked = $('.input-checkbox').filter(':checked');
    const itemIds = [];
    checked.each((index, element) => {
        itemIds.push($(element).val())
    })
    console.log('itemIds', itemIds)
    confirmPopup({
        callbackAction: () => callbackAction(action, {itemIds})
    })
})
$(document).ready(function () {
    $('#form-search').submit(function (e) {
        e.preventDefault();
        const keyword = $('#search').val();
        replaceUrl('keyword', keyword)
    })
    const selectList = $('.select-filter');
    selectList.change(function () {
        const name = $(this).attr('name');
        const value = $(this).val();
        replaceUrl(name, value)
    })
});
