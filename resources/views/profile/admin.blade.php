@extends('main-layout.layout')

@section('title', 'Admin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Admin</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Admin</h5>

    <b>
    @if(session('success'))
        <div style="text-align: center" class="alert alert-success">{{session('success')}}</div>
    @endif

    @if(session('warning'))
        <div style="text-align: center" class="alert alert-warning">{{session('warning')}}</div>
    @endif
    </b>

<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Address</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($admin as $adm)
      <tr>
        <th scope="row">{{$adm->id}}</th>
        <td>{{$adm->name}}</td>
        <td>{{$adm->email}}</td>
        <td>{{$adm->number}}</td>
        <td>{{$adm->address}}</td>
        <td>
            <form id="delete-admin-{{$adm->id}}" action="/admin-delete/{{$adm->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
            </form>
            <button type="submit" class="btn btn-danger rounded-pill" onclick="event.preventDefault(); confirmDelete({{$adm->id}});"><i class="bi bi-trash"> Delete</i></button>
            <script>
                function confirmDelete(id) {
                    if (confirm('Delete this account?')) {
                        document.getElementById('delete-admin-' + id).submit();
                    }
                }
                    </script>

            <button type="submit" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#adminUpdate{{$adm->id}}"><i class="bi bi-pencil"> Update</i></button>
        </td>
      </tr>

      <!--Update admin modal start-->
      <div class="modal fade" id="adminUpdate{{$adm->id}}" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update admin</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="min-height: 330px;">
              <div class="col-12">
                <form class="row g-3" id="update-admin-{{$adm->id}}" action="/admin-update/{{$adm->id}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="col-6">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{$adm->name}}">
                    </div>
                    <div class="col-6">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="text" class="form-control" id="email" value="{{$adm->email}}">
                    </div>
                    <div class="col-12">
                        <label for="number" class="form-label">Phone</label>
                        <input name="number" type="text" class="form-control" id="number" value="{{$adm->number}}">
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input name="address" type="text" class="form-control" id="address" value="{{$adm->address}}">
                    </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('update-admin-{{$adm->id}}').submit();">Save changes</button>
            </div>
        </form>
          </div>
        </div>
      </div><!-- End Scrolling Modal-->

      @endforeach
    </tbody>
  </table>
  <!-- End Table with stripped rows -->

</div>
</div>

</div>
</div>
</section>

</main><!-- End #main -->
@endsection
