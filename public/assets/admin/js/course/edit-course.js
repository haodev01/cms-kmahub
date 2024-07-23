// Xử lý thumbnail
const thumbnail = $('#thumbnail')
const selectThumb = $('#selectThumb')
const imageThumbnail = $('#image-thumbnail')

function displayThumbnailPreivew(src) {
    imageThumbnail.attr('src', src)
    imageThumbnail.show()
    iconClose.show()
}

thumbnail.change((event) => {
    let input = event.target
    if (input.files && input.files[0]) {
        let reader = new FileReader()
        reader.onload = (e) => {
            displayThumbnailPreivew(e.target.result)
        }
        reader.readAsDataURL(input.files[0])
    }
})
selectThumb.click(() => {
    thumbnail.click()
})

//Xử lý video
const selectVideo = $('#selectVideo')
const inputVideo = $('#inputVideo')
const videoDisplay = $('#videoDisplay')
selectVideo.click(() => {
    inputVideo.click();
})

function displayVideoPreivew(src) {
    videoDisplay.attr('src', src)
    videoDisplay.show();
    iconCloseVideo.show()
}

inputVideo.change((event) => {
    let file = event.target.files[0];
    let blobURL = URL.createObjectURL(file);
    displayVideoPreivew(blobURL)
})
const requimentList = $('.requiment-list');
const benefitList = $('.benefit-list');
$('#add-requiment').click(() => {
    const inputElement = `
             <div class="d-flex align-items-center mb-3">
                 <input type="text" name="requirments[]" class="form-control mr-2 ">
                 <button  class="btn btn-danger btn-sm btn-remove-requirement " type="button">
                         <i class="fa fa-trash"></i>
                 </button>
             </div>
            `
    requimentList.append(inputElement)
    $('.btn-remove-requirement').click(function () {
        const button = $(this);
        button.parent().remove()
    })
})
$('.btn-remove-requirement').click(function () {
    const button = $(this);
    button.parent().remove()
})
$('#add-benefit').click(() => {
    const inputElement = `
             <div class="d-flex align-items-center mb-3">
                 <input type="text" name="benefits[]"  class="form-control mr-2 ">
                 <button  class="btn btn-danger btn-sm btn-remove-benefit " type="button">
                         <i class="fa fa-trash"></i>
                 </button>
             </div>
            `
    benefitList.append(inputElement)
    $('.btn-remove-benefit').click(function () {
        const button = $(this);
        button.parent().remove()
    })
})
$('.btn-remove-benefit').click(function () {
    const button = $(this);
    button.parent().remove()
})

const formSubmit = $('#formSubmit');
formSubmit.on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        const id = form.data('id');
        const formData = new FormData(this);
        fetcher.post(`/admin/courses/updateForm/${id}`, formData, {
            processData: false,
            contentType: false,
            success: function (response) {
                alertSuccess(response.message, () => {
                    window.location.reload()
                })
            },
            error: function (response) {
                const errors = response.responseJSON.errors;
                displayErrors(errors)
            }
        })
    }
)
formSubmit.find('.form-control, .form-select').on('input change ', function () {
    const input = $(this);
    if (input.hasClass('is-invalid')) {
        input.removeClass('is-invalid');
        input.next('.text-danger').remove();
    }
});
