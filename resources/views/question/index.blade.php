@extends('layouts.app')
@section('title')
  Questions 
@endsection

@section('styles')
    @include('layouts.data_table_styles')
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4">Questions</h1>

    <div class="row">

        <div class="col-lg-12">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Questions | List</h6>
                </div>
                <div class="card-header-button">
                
                    <a href="javascript:void(0);" class="{!!config('buttons.add-class')!!}" title="Add"
                        data-toggle="modal" data-target="#myModal">
                        {!!config('buttons.add-icon')!!}
                    </a>
                    
                </div>
                <div class="card-body">
                    <div class="table-list">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="question_table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL No</th>
                                        <th>Question</th>
                                        <th>Actions</th>
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

<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="questions_form" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-xl-4">Question<i class="asterisk">*</i> </label>
                        <div class="col-xl-8">
                        <textarea name="question" class="form-control" id="question" placeholder="Question"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-4">Option 1 <i class="asterisk">*</i> </label>
                        <div class="col-xl-8">
                        <input type="text" id="first_option" name="first_option" class="form-control" placeholder="Option 1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-4">Option 2 <i class="asterisk">*</i> </label>
                        <div class="col-xl-8">
                        <input type="text" id="second_option" name="second_option" class="form-control" placeholder="Option 2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-4">Option 3 <i class="asterisk">*</i> </label>
                        <div class="col-xl-8">
                        <input type="text" id="third_option" name="third_option" class="form-control" placeholder="Option 3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-4">Option 4 <i class="asterisk">*</i> </label>
                        <div class="col-xl-8">
                        <input type="text" id="fourth_option" name="fourth_option" class="form-control" placeholder="Option 4">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-4">Correct Answer <i class="asterisk">*</i> </label>
                        <div class="col-xl-8">
                        <input type="text" id="answer" name="answer" class="form-control" placeholder="Correct Answer">
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="exam_id" id="exam_id" value="{{$id}}">
                </div>
                <div class="modal-footer">
                    <button type="submit" id="form_submit" class="btn btn-success btn-icon-split float-right">
                        <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('scripts')
    <script>
        let tableURL = "{{ route('questions', $id) }}";
        let getURL = "{{ route('getQuestion') }}";
        let saveURL = "{{ route('saveQuestion') }}";
        let deleteURL = "{{ route('deleteQuestion') }}";
    </script>
    @include('layouts.data_table_scripts')
    <script src="{{asset('assets/js/jquery-validation-1.19.1/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/question.js') }}"></script>
@endsection

