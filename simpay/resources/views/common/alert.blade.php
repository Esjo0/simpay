@if (Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-error alert-dismissible fade show" role="alert">
      <strong>Error!</strong> {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
@endif

@if (isset($_GET['error']))
<div class="alert-box danger-alert">
    <div class="alert">
      <h6 class="alert-heading">Error!!!</h6>
      <p class="text-medium">
        {{ $_GET['error'] }}
       </p>
    </div>
  </div>
@endif

@if (isset($_GET['success']))
<div class="alert-box success-alert">
    <div class="alert">
      <h6 class="alert-heading">Success!!!</h6>
      <p class="text-medium">
        {{ $_GET['success'] }}
       </p>
    </div>
  </div>
@endif