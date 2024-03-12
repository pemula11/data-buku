@extends('template.main')
@section('title', 'Data Buku')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="mx-auto py-5 col-10">
    
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  
                  <button type="button" class="btn btn-primary" data-toggle="modal" id="btn-add-buku" data-target="#add-data">
                    Tambah Data
                  </button>

                 
                  
            </div>
   </div>


   <div class="card py-3">
       <div class="card-header text-white bg-black">
           Data Buku
       </div>
       
       <div class="card-body">
           <table class="table" id="buku-table">
               <thead>
                   <tr>
                       <th scope="col">No</th>
                       <th scope="col">Title</th>
                       <th scope="col">Category</th>
                       <th scope="col">Author</th>
                       <th scope="col">publisher</th>
                       <th scope="col">publish date</th>
                       <th scope="col">Page</th>
                       <th scope="col">Aksi</th>
                   </tr>
               </thead>
               <tbody>
               
               @foreach ($buku as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td> {{$data->title}} </td>
                        <td> {{$data->category->name}}</td>
                        <td>{{$data->author}}</td>
                        <td>{{$data->publisher}}</td>
                        <td>{{$data->publish_date}}</td>
                        <td>{{$data->num_page}}</td>
                        <td>
                            <a href="javascript:void(0)" id="btn-edit-buku" data-id="{{ $data->id }}" class="badge bg-warning">
                                Edit
                            </a>
                            <form action="/book/{{ $data->id }}" class="d-inline" method="post">
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


@include('book.modal-edit')
@include('book.modal-add')

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
new DataTable('#buku-table');
</script>

@endsection

