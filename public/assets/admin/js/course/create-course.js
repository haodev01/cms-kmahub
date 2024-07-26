// Tự động sinh convert khi nhập tên khó hoc
$('#name').blur((event) => {
    $('#slug').val(convertToSlug(event.target.value))
})
// Xóa messsaage error khi input change
$('#formSubmit').find('.form-control, .form-select').on('input change ', function () {
    var input = $(this);
    if (input.hasClass('is-invalid')) {
        input.removeClass('is-invalid');
        input.next('.text-danger').remove();
    }
});
let countInputRequiment = 0;
const convertToSlug = (str) => {

    str = str.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    str = str.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    str = str.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    str = str.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    str = str.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    str = str.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    str = str.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    str = str.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    str = str.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    str = str.replace(/ /gi, " - ");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    str = str.replace(/\-\-\-\-\-/gi, '-');
    str = str.replace(/\-\-\-\-/gi, '-');
    str = str.replace(/\-\-\-/gi, '-');
    str = str.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    str = '@' + str + '@';
    return str.replace(/\@\-|\-\@|\@/gi, '').replaceAll(' ', '');
}


$('#buttonAddInputRequiment').click(() => {
    $('#list-requiment').append('<input type="text" name="requiments[]" id=`requiments-' + ++countInputRequiment + '`  class="form-control mb-1">')
})

// Xử lý thumbnail
const thumbnail = $('#thumbnail')
const selectThumb = $('#selectThumb')
const iconClose = $('#iconClose')
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
iconClose.click(() => {
    imageThumbnail.attr('src', '')
    imageThumbnail.hide()
    iconClose.hide()
    thumbnail.wrap('<form>').closest('form').get(0).reset();
    thumbnail.unwrap();
})
selectThumb.click(() => {
    thumbnail.click()
})

//Xử lý video
const selectVideo = $('#selectVideo')
const inputVideo = $('#inputVideo')
const videoDisplay = $('#videoDisplay')
const iconCloseVideo = $('#iconCloseVideo')
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
iconCloseVideo.click(() => {
    videoDisplay.hide()
    videoDisplay.attr('src', '')
    iconCloseVideo.hide()
    inputVideo.wrap('<form>').closest('form').get(0).reset();
    inputVideo.unwrap();
})
$('#formSubmit').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetcher.post('/courses', formData, {
            processData: false,
            contentType: false,
            success: function (response) {
                const {id} = response.data
                window.location.href = '/courses/update-content/' + id
            },
            error: function (response) {
                const errors = response.responseJSON.errors;
                displayErrors(errors)
            }
        })
    }
)
const requimentList = $('.requiment-list');
const benefitList = $('.benefit-list');
$('#add-requiment').click(() => {
    const inputElement = `
             <div class="d-flex align-items-center mb-3">
                 <input type="text" name="requirments[]"  class="form-control mr-2 ">
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
window.addEventListener('beforeunload', function (event) {
    const message = 'Bạn có chắc chắn muốn rời khỏi trang này không?';
    event.preventDefault();
    event.returnValue = message;

    return message;
});
