@extends('template.main')
@section('title', 'Data Kategori')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="mx-auto py-5 col-5">
    
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  
                  <button type="button" class="btn btn-primary" data-toggle="modal" id="btn-add-kategori" data-target="#add-data">
                    Tambah Data
                  </button>

                 
                  
            </div>
   </div>


   <div class="card py-3">
       <div class="card-header text-white bg-black">
           Data Kategori
       </div>
       
       <div class="card-body">
           <table class="table" id="kategori-table">
               <thead>
                   <tr>
                       <th scope="col">No</th>
                       <th class="col-8" scope="col">Title</th>
                       <th scope="col">Aksi</th>
                   </tr>
               </thead>
               <tbody>
               
               @foreach ($category as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td> {{$data->name}} </td>
                        <td>
                            <a href="javascript:void(0)" id="btn-edit-kategori" data-id="{{ $data->id }}" class="badge bg-warning">
                                Edit
                            </a>
                            <form action="/category/{{ $data->id }}" class="d-inline" method="post">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('yakin hapus data?')"> 
                                    
                                    Hapus
                                    
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                   
               
                  </tbody>
              </table>
          </div>
</div>


@include('category.modal-edit')
@include('category.modal-add')

@if ($errors->all())

    <script> $(document).ready(function()
        { 
        $('#add-data').modal('show'); 
        }); 
    </script>

    
    
@else
    <script> $(document).ready(function()
        { 
        $('#add_data').modal('hide'); 
        }); 
    </script>
@endif

<script>
new DataTable('#kategori-table');
</script>



@if (session('failed'))
        <script>
        Swal.fire({
                    type: 'warning',
                    icon: 'error',
                    title: 'Resource cannot be deleted due to existence of related resources',
                    showConfirmButton: false,
                    timer: 3000
                });
        </script>
    @endif

@endsection

