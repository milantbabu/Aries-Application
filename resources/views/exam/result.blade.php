@extends('layouts.app')
@section('title')
  Results 
@endsection

@section('styles')
    @include('layouts.data_table_styles')
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4">Exam Results</h1>

    <div class="row">

        <div class="col-lg-12">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Results | List</h6>
                </div>
                <div class="card-header-button">
                    
                </div>
                <div class="card-body">
                    <div class="table-list">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="result_table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Name </th>
                                        <th>Email</th>
                                        <th>Exam</th>
                                        <th>Your Score</th>
                                        <th>Total Mark</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

 


@endsection
@section('scripts')
    <script>
        let page = 'resultPage';
        let tableURL = "{{ route('results') }}";
    </script>
    @include('layouts.data_table_scripts')
    <script src="{{asset('assets/js/jquery-validation-1.19.1/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/attend.js') }}"></script>
@endsection

