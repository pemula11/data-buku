<!-- Modal -->
<div class="modal fade" id="add-data" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Buku</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <!-- form -->
            <form action="/book" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3 row form-group">
                    <label for="t" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}" required>
                        @error('title')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           {{ $message }}.
                         </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row form-group">
                    <label for="author" class="col-sm-3 col-form-label">Author</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{old('author')}}" required>
                        @error('author')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           {{ $message }}.
                         </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row form-group">
                    <label for="nama" class="col-sm-3 col-form-label">Publisher</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher" name="publisher" value="{{old('publisher')}}" required>
                        @error('publisher')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           {{ $message }}.
                         </div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3 row form-group">
                    <label for="nama" class="col-sm-3 col-form-label">Publish Date</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control @error('publish_date') is-invalid @enderror" id="publish_date" name="publish_date" value="{{old('publish_date')}}" required>
                        @error('publish_date')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           {{ $message }}.
                         </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row form-group">
                    <label for="nama" class="col-sm-3 col-form-label">Total page</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control @error('num_page') is-invalid @enderror" id="num_page" name="num_page" value="{{old('num_page')}}" required>
                        @error('num_page')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           {{ $message }}.
                         </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row form-group">
                    <label for="nama" class="col-sm-3 col-form-label">category</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" value="{{old('category_id')}}" required>
                        @error('category_id')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                           {{ $message }}.
                         </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12" align="right">
                    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                </div>
            </form>
            <!-- endform -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="close-add" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>

  <script>
        $("#kode_gejala").on({
    keydown: function(e) {
    if (e.which === 32 || e.which == 222 || e.which == 221 || e.which == 219 || e.which == 220 || e.which == 187)
        return false;
    
    },
    change: function() {
        this.value = this.value.replace(/\s/g, "");   
    }
    
    });

    $('body').on('click', '#btn-add-buku', function () {
        $('#add-data').modal('show'); 
    });
    $('#close-add').click(function(e) {
        $('#add-data').modal('hide');
    });


    
  </script>

    @if (session('success'))
        <script>
        Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'data berhasil ditambah',
                    showConfirmButton: false,
                    timer: 3000
                });
        </script>
    @endif