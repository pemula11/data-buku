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
            <form action="/category" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3 row form-group">
                    <label for="t" class="col-sm-3 col-form-label">name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('title')}}" required>
                        @error('title')
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
        

    $('body').on('click', '#btn-add-kategori', function () {
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