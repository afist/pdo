

$('.district').click(function(){
    $('.new-table').remove();
    $('.modal-district').css('display','block');
    $('.modal-street').css('display','none');
    $.ajax({
        url: "/districts",
        type: "GET",
        success(a){
            $(a).insertAfter( $(".table") );
        }
    });

})

$('.street').click(function(){
    $('.new-table').remove();
    $('.modal-district').css('display','none');
    $('.modal-street').css('display','block');
    $.ajax({
        url: "/street",
        type: "GET",
        success(a){
            $(a).insertAfter( $(".table") );
        }
    });

})


setTimeout(function(){

    $('.modal-district').click(function() {

        var modalWindow = $(".district-modal");
        M1.modalShow(modalWindow);
        $("#overlay-popup-m1").show();
        return false;
    });

    $(window).click(function(e) {
        var target = $(event.target);
        if (target.is("#overlay-popup-m1")) {
            $("#overlay-popup-m1").hide();
            $(".district-modal").hide();
            $(".edit-modal").hide();

        }
    });


    $('.add-district').click(function(event){
        var serializedData = $(this).parent().serialize();
        request = $.ajax({
            url: "/districts",
            type: "POST",
            data: serializedData,
            success(a){
            }
        });

    });

    $('.edit-district').click(function(){
        var serializedData = $(this).parent().serialize();
        // console.log(serializedData['id']);
        request = $.ajax({
            url: "/districts/"+serializedData['idedit'],
            type: "POST",
            data: serializedData,
            success(a){
            }
        });

    });

    $('.edit').click(function () {
        var id = $(this).parent().parent().find('td.id').html();
        var modalWindow = $(".edit-modal");
        M1.modalShow(modalWindow);
        $("#overlay-popup-m1").show();
        $('.edit-id').val(id);

        request = $.ajax({
            url: "/districts/"+id,
            type: "GET",
            success(a){
                var arr = a.split(';');
                $(".edit-modal [name='name']").val(arr[0]);
                $(".edit-modal [name='population']").val(arr[1]);
                $(".edit-modal [name='description']").val(arr[2]);
            }
        });
        return false;
    });

    $('.delete').click(function () {
        var id = $(this).parent().parent().find('td.id').html();
        request = $.ajax({
            url: "/districts/"+id,
            type: "DELETE",
            success(a){
                location.reload();
            }
        });
    });

}, 500);

