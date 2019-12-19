$(document).ready(function () {

    $('input.btn-delete').click(function () {
        let pathname = 'delete/';
        let id = $(this).data('id');
        let _csrf = $(this).data('csrf');
        let tr = $(this).closest('tr');
        console.log(pathname);

        $.ajax({
            type: "POST",
            url: pathname,
            data: {'id': id, '_csrf': _csrf},
            success: function (data) {
                console.log('success');
                console.log(data);
                tr.remove();
            },
            error: function (data) {
                console.log('error');
                console.log(data);
            }
        });

    });

    $('input.btn-update').click(function () {
        let id = $(this).data('id');
        let pathname = 'update/'+id;
        let _csrf = $(this).data('csrf');
        $.ajax({
            type: "POST",
            url: pathname,
            data: {'id': id, '_csrf': _csrf},
            success: function (data) {
                console.log('success');
                console.log(data);
            },
            error: function (data) {
                console.log('error');
                console.log(data);
            }
        });
    });
    $('input[type="checkbox"]').change(function(){
        this.value = (Number(this.checked));
    });


    if($('#url').is(":visible")){
        bootstrapValidate('#url', 'url:Please enter a valid URL!')
    }

    if($('#name').is(":visible")){
        bootstrapValidate('#name', 'alphanum:Please only enter alphanumeric characters!');
    }

    $('.up,.down').click(function () {

        let row = $(this).parents('tr:first');
        let curPos = row.find("td.form-label").text();
        let curID = row.find("td>input").data('id');
        let neighborhoodID = 0;
        let neighborhoodPos = 0;

        if ($(this).is('.up')) {
            console.log('UP');
            neighborhoodID = row.prev().find("td>input").data('id');
            neighborhoodPos = row.prev().find("td.form-label").text();

            if(neighborhoodPos > 0) {
                row.prev().find("td.form-label").text(curPos);
                row.find("td.form-label").text(neighborhoodPos);
            }
            row.insertBefore(row.prev());


        }
        else {
            console.log('DOWN');
            neighborhoodPos = row.next().find("td.form-label").text();
            neighborhoodID = row.next().find("td>input").data('id');
            if(neighborhoodPos > 0) {
                row.find("td.form-label").text(neighborhoodPos);
                row.next().find("td.form-label").text(curPos);
            }
            row.insertAfter(row.next());
        }
        if( curID > 0 &&
            neighborhoodID > 0
        ) {
            $.ajax({
                type: "POST",
                url: 'changePosition/',
                data: {'curPos': curPos, 'curID': curID, 'nPos': neighborhoodPos, 'nID': neighborhoodID},
                success: function (data) {
                    console.log('success');
                    console.log(data);
                },
                error: function (data) {
                    console.log('error');
                    console.log(data);
                }
            });
        }


    });

});

