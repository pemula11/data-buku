<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT POST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-3 row form-group">

                <input type="hidden" id="category_id">

                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" id="name-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>
                </div>
                


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal-edit">TUTUP</button>
                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create post event
    $('body').on('click', '#btn-edit-kategori', function () {

        let category_id = $(this).data('id');
        

        //fetch detail post with ajax
        $.ajax({
            url: `/category/${category_id}`,
            type: "GET",
            cache: false,
            success:function(response){

                //fill data to form
                $('#category_id').val(response.data.id);
                $('#name-edit').val(response.data.name);
                
                //open modal
                $('#modal-edit').modal('show');
            }
        });
        
    });

    //action update post
    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let category_id = $('#category_id').val();
        let name   = $('#name-edit').val();
        let token   = $("meta[name='csrf-token']").attr("content");

        //ajax
        $.ajax({

            url: `/category/${category_id}`,
            type: "PUT",
            cache: false,
            data: {
                "name": name,
               
                "_token": token
            },
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    timer: 3000
                    }).then(function(){ 
                         location.reload();
                     }
                );

                //data post
              

                //close modal
                $('#modal-edit').modal('hide');
                

            },
            error:function(error){
                console.log(error);
                if(error.responseJSON.title[0]) {

                    //show alert
                    $('#alert-title-edit').removeClass('d-none');
                    $('#alert-title-edit').addClass('d-block');

                    //add message to alert
                    $('#alert-title-edit').html(error.responseJSON.title[0]);
                } 

                if(error.responseJSON.content[0]) {

                    //show alert
                    $('#alert-content-edit').removeClass('d-none');
                    $('#alert-content-edit').addClass('d-block');

                    //add message to alert
                    $('#alert-content-edit').html(error.responseJSON.content[0]);
                } 

            }

        });

    });

    $('#close').click(function(e) {
        $('#modal-edit').modal('hide');
    });

</script>