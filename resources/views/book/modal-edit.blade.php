<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT POST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="book_id">

                <div class="form-group">
                    <label for="name" class="control-label">Title</label>
                    <input type="text" class="form-control" id="title-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title-edit"></div>
                </div>
                

                <div class="form-group">
                    <label for="name" class="control-label">Author</label>
                    <input type="text" class="form-control" id="author-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Category</label>
                    <input type="text" class="form-control" id="category-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Publisher</label>
                    <input type="text" class="form-control" id="publisher-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Publish Date</label>
                    <input type="date" class="form-control" id="date-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Num Page</label>
                    <input type="number" class="form-control" id="page-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title-edit"></div>
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
    $('body').on('click', '#btn-edit-buku', function () {

        let book_id = $(this).data('id');

        //fetch detail post with ajax
        $.ajax({
            url: `/book/${book_id}`,
            type: "GET",
            cache: false,
            success:function(response){

                //fill data to form
                $('#book_id').val(response.data.id);
                $('#title-edit').val(response.data.title);
                $('#author-edit').val(response.data.author);
                $('#category-edit').val(response.data.category_id);
                $('#publisher-edit').val(response.data.publisher);
                $('#date-edit').val(response.data.publish_date);
                $('#page-edit').val(response.data.num_page);

                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update post
    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let book_id = $('#book_id').val();
        let title   = $('#title-edit').val();
        let author   = $('#author-edit').val();
        let category   = $('#category-edit').val();
        let publisher   = $('#publisher-edit').val();
        let date   = $('#date-edit').val();
        let page   = $('#page-edit').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/book/${book_id}`,
            type: "PUT",
            cache: false,
            data: {
                "title": title,
                "author": author,
                "category_id": category,
                "publisher": publisher,
                "publisht_date": date,
                "num_page": parseInt(page),
                "_token": token
            },
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //data post
                let post = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.title}</td>
                        <td>${response.data.content}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to post data
                $(`#index_${response.data.id}`).replaceWith(post);

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