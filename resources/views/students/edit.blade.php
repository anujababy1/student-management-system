@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Edit {{$student->name}}
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

                 <form method="post" action="{{ route('students.update',$student->id) }}">
                    @csrf
                     @method('PUT')
                    <div class="form-group">    
                        <label for="first_name">Name:</label>
                         <input type="text" class="form-control" value="{{$student->name}}" name="name"  required  placeholder="please enter student name"/>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Age:</label>
                        <input type="number" class="form-control" name="age" value="{{ $student->age }}" required min="5" max="20" placeholder="please enter student age"/>
                    </div>
                    <div class="form-group">
                      <label>Gender:</label>
                      <br/>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" {{($student->gender=="male")? "checked" : "" }} value="male" required>
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" {{ ($student->gender=='female')? "checked" : "" }} value="female">
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                      </div>
                    </div>
                    <div class="form-group">
                    <label for="reporting_teacher">Reporting Teacher:</label>
                      <select class="form-control" id="reporting_teacher" name="reporting_teacher" required>
                        <option value="">select a teacher</option>
                        @foreach($teachers as $teacher)
                          <option {{ ($student->reporting_teacher) == $teacher ? 'selected' : '' }} value="{{$teacher}}">{{ucfirst($teacher)}}</option>
                        @endforeach
                      </select>
                    </div>                         
                      <button type="submit" class="btn btn-primary">Update</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
