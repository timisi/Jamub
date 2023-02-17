//update token
$("form").submit(function () {
    $("input[name='" + csfr_token_name + "']").val($.cookie(csfr_cookie_name));
});


//datatable
$(function () {
    $(document).ready(function () {
        $('#cs_datatable').DataTable({
            "order": [[0, "desc"]],
            "aLengthMenu": [[15, 30, 60, 100], [15, 30, 60, 100, "All"]]
        });
    });
});

$(function() {
    $('#tags_1').tagsInput({width:'auto'});
});

//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-orange, input[type="radio"].flat-orange').iCheck({
    checkboxClass: 'icheckbox_flat-orange',
    radioClass: 'iradio_flat-orange'
});
$('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
});
$('input[type="checkbox"].square-purple, input[type="radio"].square-purple').iCheck({
    checkboxClass: 'icheckbox_square-purple',
    radioClass: 'iradio_square-purple',
    increaseArea: '20%' // optional
});

//color picker with addon
$(".my-colorpicker").colorpicker();


function get_sub_categories(val) {

    var data = {
        "parent_id": val
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "admin_category/get_sub_categories",
        data: data,
        success: function (response) {
            $("#subcategories").html(response);
        }
    });
}

//datetimepicker
$(function () {
    $('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
});

$('#cb_scheduled').on('ifChecked', function () {
    $("#date_published_content").show();
    $("#input_date_published").prop('required', true);
});
$('#cb_scheduled').on('ifUnchecked', function () {
    $("#date_published_content").hide();
    $("#input_date_published").prop('required', false);
});

//Multi Image Previev
window.onload = function () {
    var MultifileUpload = document.getElementById("Multifileupload");
    if (MultifileUpload) {
        MultifileUpload.onchange = function () {
            if (typeof (FileReader) != "undefined") {
                var MultidvPreview = document.getElementById("MultidvPreview");
                MultidvPreview.innerHTML = "";
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                for (var i = 0; i < MultifileUpload.files.length; i++) {
                    var file = MultifileUpload.files[i];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement("IMG");
                        img.height = "100";
                        img.width = "100";
                        img.src = e.target.result;
                        img.id = "Multifileupload_image";
                        MultidvPreview.appendChild(img);
                        $("#Multifileupload_button").show();
                    }
                    reader.readAsDataURL(file);
                }
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        }
    }
};


/*
*
* Video Upload Functions
*
* */

$("#video_embed_code").on("change keyup paste", function () {
    var embed_code = $("#video_embed_code").val();
    $("#video_preview").attr('src', embed_code);

    if ($("#video_embed_code").val() == '') {
        $("#img_video_thumbnail").attr('src', '');
    }
});


function get_video_from_url() {

    var url = $("#video_url").val();

    if (url) {
        var data = {
            "url": url,
        };

        data[csfr_token_name] = $.cookie(csfr_cookie_name);

        $.ajax({
            type: "POST",
            url: base_url + "admin_video/get_video_from_url",
            data: data,
            success: function (response) {
                $("#video_embed_code").html(response);
                if (response != "Invalid Url") {
                    $("#video_embed_preview").attr('src', response);
                    $("#video_embed_preview").show();
                }
            }
        });

        $.ajax({
            type: "POST",
            url: base_url + "admin_video/get_video_thumbnail",
            data: data,
            success: function (response) {
                $("#video_thumbnail_url").val(response);
                $("#img_video_thumbnail").attr('src', response);
            }
        });
    }
}

$("#video_thumbnail_url").on("change keyup paste", function () {
    var url = $("#video_thumbnail_url").val();
    $("#img_video_thumbnail").attr('src', url);
});

//reset file input
function reset_file_input(id) {
    $(id).val('');
    $(id + "_label").html('');
    $(id + "_button").hide();
}

//reset preview image
function reset_preview_image(id) {
    $(id).val('');
    $(id + "_image").remove();
    $(id + "_button").hide();
}

//upload post image to session
function upload_post_image_session(type_name) {

    var file = $('#input_image_file').prop('files')[0];

    if (file) {

        $("#post_image_upload_loader").show();
        $("#post_image_upload_button").prop("disabled", true);

        var form_data = new FormData();
        form_data.append('input_post_image_file', file);
        form_data.append('type_name', type_name);
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $.ajax({
            method: 'POST',
            url: base_url + "admin_post/upload_post_image_session",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById("post_image_upload_result").innerHTML = response;
                $("#post_image_upload_loader").hide();
                $("#post_image_upload_button").prop("disabled", false);
            },
            error: function (response) {
            }
        });
    }
};

//upload post image
function upload_post_image(post_id) {

    var file = $('#input_image_file').prop('files')[0];

    if (file) {

        $("#post_image_upload_loader").show();
        $("#post_image_upload_button").prop("disabled", true);

        var form_data = new FormData();
        form_data.append('input_post_image_file', file);
        form_data.append('post_id', post_id);
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $.ajax({
            method: 'POST',
            url: base_url + "admin_post/upload_post_image",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById("post_image_upload_result").innerHTML = response;
                $("#post_image_upload_loader").hide();
                $("#post_image_upload_button").prop("disabled", false);
            },
            error: function (response) {
            }
        });
    }

};

//delete post image from session
function delete_post_image_session(type_name) {

    var data = {
        'type_name': type_name,
    };

    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $("#post_image_upload_loader").show();
    $.ajax({
        type: "POST",
        url: base_url + "admin_post/delete_post_image_session",
        data: data,
        success: function (response) {
            document.getElementById("post_image_upload_result").innerHTML = response;
            $("#post_image_upload_loader").hide();
        }
    });
}

//upload post additional image to session
function upload_post_additional_image_session() {

    var file = $('#input_additional_image_file').prop('files')[0];

    if (file) {

        $("#post_additional_image_upload_loader").show();
        $("#post_additional_image_upload_button").prop("disabled", true);

        var form_data = new FormData();
        form_data.append('input_additional_image_file', file);
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $.ajax({
            method: 'POST',
            url: base_url + "admin_post/upload_post_additional_image_session",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById("post_images_upload_result").innerHTML = response;
                $("#post_additional_image_upload_loader").hide();
                $("#post_additional_image_upload_button").prop("disabled", false);
            },
            error: function (response) {
            }
        });
    }
};

//upload post additional image
function upload_post_additional_image(post_id) {

    var file = $('#input_additional_image_file').prop('files')[0];

    if (file) {

        $("#post_additional_image_upload_loader").show();
        $("#post_additional_image_upload_button").prop("disabled", true);

        var form_data = new FormData();
        form_data.append('input_additional_image_file', file);
        form_data.append('post_id', post_id);
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $.ajax({
            method: 'POST',
            url: base_url + "admin_post/upload_post_additional_image",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById("post_images_upload_result").innerHTML = response;
                $("#post_additional_image_upload_loader").hide();
                $("#post_additional_image_upload_button").prop("disabled", false);
            },
            error: function (response) {
            }
        });
    }

};

//delete post additional image session from session
function delete_post_additional_image_session(path) {

    var data = {
        "path": path,
    };

    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "admin_post/delete_post_additional_image_session",
        data: data,
        success: function (response) {
            document.getElementById("post_images_upload_result").innerHTML = response;
        }
    });
}

//delete post additional image
function delete_post_additional_image(image_id) {

    var data = {
        "image_id": image_id,
    };

    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "admin_post/delete_post_additional_image",
        data: data,
        success: function (response) {
            document.getElementById("post_images_upload_result").innerHTML = response;
        }
    });
}

//upload audio
function upload_audio(post_id) {

    if ($('#audio_name').val() == '') {
        $('#audio_name').css("border-color", "#3c8dbc");
        return;
    } else {
        $('#audio_name').css("border-color", "#d2d6de");
    }

    if ($('#input_audio_file').prop('files')[0]) {

        $("#audio_upload_loader").show();
        $("#audio_upload_button").prop("disabled", true);

        var form_data = new FormData();
        form_data.append('input_audio_file', $('#input_audio_file').prop('files')[0]);
        form_data.append('audio_name', $('#audio_name').val());
        form_data.append('musician', $('#musician').val());
        form_data.append('download_button', $('input[name=download_button]:checked').val());
        form_data.append('post_id', post_id);
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $("#progress-bar").width('0%');
        $.ajax({
            method: 'POST',
            url: base_url + "audio/upload_audio",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById("audio_upload_result").innerHTML = response;
                $("#audio_upload_loader").hide();
                $("#audio_upload_button").prop("disabled", false);
            },
            error: function (response) {
            }
        });
    }

};

//upload audio to session
function upload_audio_session() {

    if ($('#audio_name').val() == '') {
        $('#audio_name').css("border-color", "#3c8dbc");
        return;
    } else {
        $('#audio_name').css("border-color", "#d2d6de");
    }

    if ($('#input_audio_file').prop('files')[0]) {

        $("#audio_upload_loader").show();
        $("#audio_upload_button").prop("disabled", true);

        var form_data = new FormData();
        form_data.append('input_audio_file', $('#input_audio_file').prop('files')[0]);
        form_data.append('audio_name', $('#audio_name').val());
        form_data.append('musician', $('#musician').val());
        form_data.append('download_button', $('input[name=download_button]:checked').val());
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $("#progress-bar").width('0%');
        $.ajax({
            method: 'POST',
            url: base_url + "audio/upload_audio_session",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById("audio_upload_result").innerHTML = response;
                $("#audio_upload_loader").hide();
                $("#audio_upload_button").prop("disabled", false);
            },
            error: function (response) {
            }
        });
    }
};

//delete audio from session
function delete_audio_session(path) {

    var data = {
        "audio_path": path
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "audio/delete_audio_session",
        data: data,
        success: function (response) {
            document.getElementById("audio_upload_result").innerHTML = response;
        }
    });
}

//delete audio
function delete_audio(id) {

    var data = {
        "id": id,
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);

    $.ajax({
        type: "POST",
        url: base_url + "audio/delete_audio",
        data: data,
        success: function (response) {
            document.getElementById("audio_upload_result").innerHTML = response;
        }
    });
}

//upload video to session
function upload_video_session() {

    var file = $('#input_video_file').prop('files')[0];

    if (file) {

        $("#video_upload_loader").show();
        $("#video_upload_button").prop("disabled", true);

        var form_data = new FormData();
        form_data.append('input_video_file', file);
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $.ajax({
            method: 'POST',
            url: base_url + "admin_video/upload_video_session",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById("video_upload_result").innerHTML = response;
                $("#video_upload_loader").hide();
                $("#video_upload_button").prop("disabled", false);
            },
            error: function (response) {
            }
        });
    }
};

//upload video
function upload_video(post_id) {
    var file = $('#input_video_file').prop('files')[0];

    if (file) {

        $("#video_upload_loader").show();
        $("#video_upload_button").prop("disabled", true);

        var form_data = new FormData();
        form_data.append('input_video_file', file);
        form_data.append('post_id', post_id);
        form_data.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $.ajax({
            method: 'POST',
            url: base_url + "admin_video/upload_video",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById("video_upload_result").innerHTML = response;
                $("#video_upload_loader").hide();
                $("#video_upload_button").prop("disabled", false);
            },
            error: function (response) {
            }
        });
    }
};

//delete video from session
function delete_video_session() {

    var data = {};

    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $("#video_upload_loader").show();
    $.ajax({
        type: "POST",
        url: base_url + "admin_video/delete_video_session",
        data: data,
        success: function (response) {
            document.getElementById("video_upload_result").innerHTML = response;
            $("#video_upload_loader").hide();
        }
    });
}

//delete video
function delete_video(post_id) {
    var data = {
        'post_id': post_id,
    };

    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $("#video_upload_loader").show();
    $.ajax({
        type: "POST",
        url: base_url + "admin_video/delete_video",
        data: data,
        success: function (response) {
            document.getElementById("video_upload_result").innerHTML = response;
            $("#video_upload_loader").hide();
        }
    });

};

//check all checkboxes
$("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});

//show hide delete button
$('.checkbox-table').click(function () {
    if ($(".checkbox-table").is(':checked')) {
        $(".btn-table-delete").show();
    } else {
        $(".btn-table-delete").hide();
    }
});

//delete selected posts
function delete_selected_posts($message) {

    if (confirm($message)) {

        var post_ids = [];

        $("input[name='checkbox-table']:checked").each(function () {
            post_ids.push(this.value);
        });

        var data = {
            'post_ids': post_ids,
        };

        data[csfr_token_name] = $.cookie(csfr_cookie_name);

        $.ajax({
            type: "POST",
            url: base_url + "admin_post/delete_selected_posts",
            data: data,
            success: function (response) {
                location.reload();
            }
        });
    }

};

//delete selected comments
function delete_selected_comments($message) {

    if (confirm($message)) {

        var comment_ids = [];

        $("input[name='checkbox-table']:checked").each(function () {
            comment_ids.push(this.value);
        });

        var data = {
            'comment_ids': comment_ids,
        };

        data[csfr_token_name] = $.cookie(csfr_cookie_name);

        $.ajax({
            type: "POST",
            url: base_url + "admin/delete_selected_comments",
            data: data,
            success: function (response) {
                location.reload();
            }
        });
    }

};

$(document).ajaxStop(function () {

    $('input[type="checkbox"].square-purple, input[type="radio"].square-purple').iCheck({
        checkboxClass: 'icheckbox_square-purple',
        radioClass: 'iradio_square-purple',
        increaseArea: '20%' // optional
    });

    $('#cb_scheduled').on('ifChecked', function () {
        $("#date_published_content").show();
        $("#input_date_published").prop('required', true);
    });
    $('#cb_scheduled').on('ifUnchecked', function () {
        $("#date_published_content").hide();
        $("#input_date_published").prop('required', false);
    });

});



