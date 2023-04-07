function dropHandler(ev) {
    console.log('File(s) dropped');

    // Prevent default behavior (Prevent file from being opened)
    ev.preventDefault();

    // Use DataTransfer interface to access the file(s)
    // for (var i = 0; i < ev.dataTransfer.files.length; i++) {
    var reader = new FileReader();
    reader.onload = function (event) {
        var $img = $('#preview');
        // console.log(event.target.result)
        $img.attr('src', event.target.result);
        $img.removeClass('d-none')
        $('.uploader-wrap').addClass('d-none')
        openCropper()
    }
    reader.readAsDataURL(ev.dataTransfer.files[0]);
    // console.log('... file[' + i + '].name = ' + ev.dataTransfer.files[i].name);
    // }
}

function loadFile(event) {
    var $img = $('#preview')
    let preview = URL.createObjectURL(event.target.files[0]);
    $img.attr('src', preview)
    $img.removeClass('d-none')
    $('.uploader-wrap').addClass('d-none')
    // $img[0].onload = function() {
    // 	URL.revokeObjectURL($img[0].src) // free memory
    // }
    openCropper()
};

function Preview() {
    $('#featured').trigger('click')
}

function dragOverHandler(ev) {
    console.log('File(s) in drop zone');

    // Prevent default behavior (Prevent file from being opened)
    ev.preventDefault();
}

function UploadModal() {
    $('#uploadModal').modal('show')
}

let cropper

function openCropper() {
    const preview = document.getElementById('preview');
    let w = preview.getBoundingClientRect().width
    let h = preview.getBoundingClientRect().height
    cropper = new Cropper(preview, {
        // minContainerWidth: 498,
        // minContainerHeight: 498 * 1.5,
        aspectRatio: 2 / 3,
        // dragMode: 'none',
        // ready: function () {
            // var cropper = this.cropper;
            // let cropBoxData = cropper.getCropBoxData();
            // let canvasData = cropper.getCanvasData();
            // console.log(cropBoxData, canvasData)
            // cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
            // cropper.setCanvasData({top:0,left:0,width:498, height:498 * 1.5}).setCropBoxData({top:0,left:0,width:498, height:498 * 1.5})
        // },
        // crop(event) {
        // 	console.log(event.detail.x);
        // 	console.log(event.detail.y);
        // 	console.log(event.detail.width);
        // 	console.log(event.detail.height);
        // 	console.log(event.detail.rotate);
        // 	console.log(event.detail.scaleX);
        // 	console.log(event.detail.scaleY);
        // },
    });
}

function saveImage() {
    cropper.getCroppedCanvas().toBlob((blob) => {
        let name = new Date().toJSON().slice(0, 19).replace(/([T\-\:])/g, '')
        let file = new File([blob], name + ".jpg", { type: "image/jpeg", lastModified: new Date().getTime() });
        let container = new DataTransfer();
        container.items.add(file);
        $('#featured')[0].files = container.files;
        $('#uploadModal').modal('hide')
    })
}

function closeModal() {
    $('#uploadModal').modal('hide')
}