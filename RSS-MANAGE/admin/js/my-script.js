function changeStatus(link) {
    $.get(link, function (data) {
        let obj = JSON.parse(data);
        console.log(obj);
        $("#status-" + obj.id).html(obj.statusHTML);
    })
}
$(document).ready(function () {
    $(".btn-delete").on('click', function (event) {
        event.preventDefault();
        if (confirm('DO YOU WAT TO DELETE ?')) {
            window.location.href = $(this).attr("href");
            alert('deleted');
        }

    })
    $(".btn-save").on('click', function (event) {
        event.preventDefault();
        if (confirm('DO YOU WAT TO SAVE ?')) {
            $("#form-table").submit();
            alert('Saved');
        }
    })
    $(".btn-cancel").on('click', function (event) {
        event.preventDefault();
        if (confirm('DO YOU WAT TO SAVE ?')) {
            window.location.href = $(this).attr("href");
            alert('Saved');
        }
    })
})
