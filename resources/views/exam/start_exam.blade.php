@extends('layouts.app')

@section('title')
Start Exam
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4">Start Exam</h1>

    <div class="row">

        <div class="col-lg-12">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Exam Start (Each question carries 1 mark)</h6>
                </div>
                <div class="card-header-button">
                    {{-- Buttons here --}}
                </div>
                <div class="card-body">
                    <form  method="post" id="submit_exam_form">
                        <div class="row">
                            @php
                            $i = 1;
                            @endphp
                            @foreach($questions as $question)
                            <div class="form-group col-md-12">
                                <p>{{ $i++ }}. {{ $question->question }}</p>
                                <input type="hidden" name="question_ids[]" value="{{ $question->id }}">

                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $question->first_option}}">
                                <label for="option1">{{ $question->first_option }}</label><br>

                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $question->second_option }}">
                                <label for="option2">{{ $question->second_option }}</label><br>

                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $question->third_option }}">
                                <label for="option3">{{ $question->third_option }}</label><br>

                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $question->fourth_option }}">
                                <label for="option4">{{ $question->fourth_option }}</label><br>
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="id" value="{{ $resultId }}">
                        <button type="submit" id="submit_exam_btn" class="btn btn-primary">Submit Exam</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')
  <script>
    let page = 'startExam';
    let saveExamurl = "{{ route('submitExam') }}";
  </script>
  <script src="{{asset('assets/js/jquery-validation-1.19.1/dist/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('assets/js/attend.js') }}"></script>
@endsection
