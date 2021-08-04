@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Add student mark
              </div>
                <div class="card-body">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                    </div><br />
                    @endif

                    <form method="post" action="{{ route('marks.store') }}">
                      @csrf 
                    <div class="form-group">
                      <label for="student_name">Student Name:</label>
                      <select class="form-control" id="student_name" name="student_id" required>
                        <option value="">select a student</option>
                        @foreach($students as $student)
                          <option value="{{$student->id}}">{{$student->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">    
                      <label for="term">Term:</label>
                      <select class="form-control" id="term" name="term" required>
                        <option value="">select a term</option>
                        @foreach($terms as $term)
                          <option  value="{{$term}}">{{ucfirst($term)}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="maths">Maths</label>
                        <input type="number" class="form-control" name="maths"  required min="0" max="100" placeholder="please enter maths mark"/>
                    </div>
                    <div class="form-group">
                        <label for="science">Science</label>
                        <input type="number" class="form-control" name="science"  required min="0" max="100" placeholder="please enter science mark"/>
                    </div>
                    <div class="form-group">
                        <label for="history">History</label>
                        <input type="number" class="form-control" name="history"  required min="0" max="100" placeholder="please enter history mark"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Add mark</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
