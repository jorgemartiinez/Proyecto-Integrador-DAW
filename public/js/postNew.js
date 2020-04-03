$(document).ready(function() {

    $('#summernote').summernote({
        height: 600,
        callbacks: {
            onImageUpload : function(files, editor, welEditable) {
                for(var i = files.length - 1; i >= 0; i--) {
                    sendFile(files[i]);
                }
            }
        }
    });
});
function sendFile(file) {
    var form_data = new FormData();
    form_data.append('file', file);
    $.ajax({
        data: form_data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/admin/posts/uploadImage',
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            let img = document.createElement('img');
            img.src = '/'+url;
            $('#summernote').summernote('insertNode', img);
        }
    });
}

window.addEventListener('load', function () {
    Array.from(document.getElementsByName('nivel[]')).forEach((input)=> input.addEventListener('change', function (event) {
        let check = event.target;
        if (check.value == 1 || check.value == 2) {
            Array.from(document.getElementsByName('nivel[]')).forEach((input)=>input.checked = false);
        } else {
            document.getElementsByName('nivel[]')[0].checked = false;
            document.getElementsByName('nivel[]')[1].checked = false;
        }
        check.checked = true;
    }));
    document.getElementById('newPost').addEventListener('submit', function (event) {
        if (document.getElementsByName('titulo')[0].value == '') {
            event.preventDefault();
            alert("El titulo es un campo obligatorio");
        } else if (document.getElementsByName('descripcion')[0].value == '') {
            event.preventDefault();
            alert("La descripcion es un campo obligatorio");
        } else if (Array.from(document.getElementsByName('nivel[]')).filter((input)=> input.checked == true).length == 0) {
            event.preventDefault();
            alert("El nivel es un campo obligatorio");
        } else if (Array.from(document.getElementsByName('categoria[]')).filter((input)=> input.checked == true).length == 0) {
            event.preventDefault();
            alert("La categoria es un campo obligatorio");
        } else if (document.getElementById('summernote').value == '') {
            event.preventDefault();
            alert("La noticia no tiene contenido");
        }
    });
});