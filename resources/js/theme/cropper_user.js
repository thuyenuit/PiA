var canvas = $("#canvas"),
    context = canvas.get(0).getContext("2d"),
    $result = $('#result');
var img = new Image();
$('#avatar_input').on('change', function () {
    $currentCropper = canvas.data('cropper');
    if ($currentCropper != undefined) {
        //# this will destroy the html tag
        $currentCropper.destroy();
        //# this will set cropperData to null, then when reinit later by this plugin
        canvas.data('cropper', null);
    }
    $result.empty();
    if (this.files && this.files[0]) {
        if (this.files[0].type.match(/^image\//)) {
            var reader = new FileReader();
            reader.onload = function (evt) {
                // img = new Image();
                img.onload = function () {
                    $result.append($('<img>').attr('src', img.getAttribute('src')));
                    context.canvas.height = img.height;
                    context.canvas.width = img.width;
                    context.drawImage(img, 0, 0);
                    var cropper = canvas.cropper({
                        aspectRatio: 9 / 9
                    });
                    $('#btnCrop').click(function () {
                        // Get a string base 64 data url
                        var croppedImageDataURL = canvas.cropper('getCroppedCanvas').toDataURL("image/png");
                        $result.empty();
                        $result.append($('<img>').attr('src', croppedImageDataURL));
                    });
                    $('#btnRestore').click(function () {
                        canvas.cropper('reset');
                        $result.empty();
                        $result.append($('<img>').attr('src', img.getAttribute('src')));
                    });
                };
                img.src = evt.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            alert("Invalid file type! Please select an image file.");
        }
    } else {
        alert('No file(s) selected.');
    }
});
$(document).ready(function () {
    $('#update_avatar').hide();
});
$(document).off('click', ".edit-avatar").on('click', '.edit-avatar', function () {
    $result.empty();
    $('#setting').hide();
    $('#update_avatar').show();
    // img = new Image();
    // img.crossOrigin="anonymous";
    img.src = $('#root_avatar').attr('src');
    img.onload = function () {
        context.canvas.height = img.height;
        context.canvas.width = img.width;
        context.drawImage(img, 0, 0);
        var cropper = canvas.cropper({
            aspectRatio: 9 / 9
        });
        $result.append($('<img>').attr('src', $('#root_avatar').attr('src')));
        $('#btnCrop').click(function () {
            // Get a string base 64 data url
            var croppedImageDataURL = canvas.cropper('getCroppedCanvas').toDataURL("image/png");
            $result.empty();
            $result.append($('<img>').attr('src', croppedImageDataURL));
        });
        $('#btnRestore').click(function () {
            canvas.cropper('reset');
            $result.empty();
            $result.append($('<img>').attr('src', $('#root_avatar').attr('src')));
        });
        $('#btnDestroy').click(function () {
            $currentCropper = canvas.data('cropper');
            $currentCropper.destroy();
        });
        $('#btnRotateRight').click(function () {
            $('#canvas').cropper('rotate', 45);
        });
        $('#btnRotateLeft').click(function () {
            $('#canvas').cropper('rotate', -45);
        });
        $('#btnRotateUpSideDown').click(function () {
            $('#canvas').cropper('rotate', 180);
        });
        $('#btnZoomIn').click(function () {
            $('#canvas').cropper('zoom', 1);
        });
        $('#btnZoomOut').click(function () {
            $('#canvas').cropper('zoom', -1);
        });
    };

});

$('#submit-avatar-form').click(function (e) {
    e.preventDefault();
    $image = $('#result img').attr('src');
    $('#update-avatar-form').append("<input type='hidden' name='image" + "' value='" + $image + "' />");
    $("#update-avatar-form").submit();

})
