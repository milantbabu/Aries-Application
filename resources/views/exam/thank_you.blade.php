@extends('layouts.app')
@section('title')
    Thank You
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4">Thank You</h1>

    <div class="row">

      <div class="col-lg-12">

        <!-- Circle Buttons -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thank You</h6>
          </div>
          <div class="card-header-button">
              {{-- Buttons here --}}
          </div>
          <div class="card-body">

            <form action="#" method="post" id="attend_form">
                <div class="row">
                    <div class="col-md-12">
                        <h3>
                            Thank you for attending exam in aries application
                        </h3>
                    </div>
                    <div class="col-lg-12">
                        <h4>
                            <span>
                               You can achieve {{ $result->mark}} out of {{ $totalMark }}
                            </span>
                        </h4>
                    </div>
                </div>
            </form>
          </div>
        </div>

      </div>

    </div>

  </div>


@endsection
