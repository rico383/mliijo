@extends('main-layout.layout')

@section('title', 'Customer')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Customer</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Customer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Customer</h5>

              <b>
                @if(session('success'))
                    <div style="text-align: center" class="alert alert-success">{{session('success')}}</div>
                @endif
                </b>

<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Number</th>
        <th scope="col">Address</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>

    @foreach($customer as $cust)

      <tr>
        <td>{{$cust->name}}</td>
        <td>{{$cust->email}}</td>
        <td>{{$cust->number}}</td>
        <td>{{$cust->address}}</td>
        <td>
            <form id="customer-delete-{{$cust->id}}" action="/customer-delete/{{$cust->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
        </form>
        <button type="submit" class="btn btn-danger rounded-pill" onclick="event.preventDefault(); confirmDelete({{$cust->id}});"><i class="bi bi-trash"> Delete</i></button>

        <script>
            function confirmDelete(id) {
                if (confirm('Delete this account?')) {
                    document.getElementById('customer-delete-' + id).submit();
                }
            }
        </script>

        </td>
      </tr>
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
