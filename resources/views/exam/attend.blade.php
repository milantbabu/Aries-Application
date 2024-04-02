@extends('layouts.app')
@section('title')
 Attend Exam
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4">Attend Exam</h1>

    <div class="row">

      <div class="col-lg-12">

        <!-- Circle Buttons -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Attend Exam</h6>
          </div>
          <div class="card-header-button">
              {{-- Buttons here --}}
          </div>
          <div class="card-body">

            <form action="#" method="post" id="attend_form">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Name <i class="asterisk">*</i></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title">Email <i class="asterisk">*</i></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email ID">
                    </div>
                    <div class="form-group col-md-12">
                      <button type="submit" id="form_submit" class="btn btn-success btn-icon-split float-right">
                          <span class="icon text-white-50">
                          <i class="fas fa-check"></i>
                          </span>
                          <span class="text">Process to Continuous</span>
                      </button>
                    </div>
                </div>
            </form>
          </div>
        </div>

      </div>

    </div>

  </div>


@endsection

@section('scripts')
    <script>
        let page = 'attendExam';
        var saveURL = "{{ route('saveUser') }}";
        var examId = "{{ $id }}";
    </script>
     <script src="{{asset('assets/js/jquery-validation-1.19.1/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/attend.js') }}"></script>
@endsection