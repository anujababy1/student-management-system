@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                	Students
                	<a  href="{{ route('students.create')}}" class="btn btn-primary btn-sm" style="float: right;">Add student</a>
            	</div>

                <div class="card-body">

                	 @if(session()->get('success'))
					    <div class="alert alert-success">
					      {{ session()->get('success') }}  
					    </div>
  					@endif  
                    <table id="student-table" class="table">
					    @if(count($students)==0)
					      <p style="text-align:center;">No results found</p>
					    @else
					    <thead>
					        <tr>
					          <th>ID</th>
					          <th>Name</th>
					          <th>Age</th>
					          <th>Gender</th>
					          <th>Reporting Teacher</th>
					          <th colspan = 2>Actions</th>
					        </tr>
					    </thead>
					    <tbody>
					        @foreach($students as $student)
					        <tr>
					            <td>{{$student->id}}</td>
					            <td>{{$student->name}}</td>
					            <td>{{$student->age}}</td>
					            <td>{{$student->gender}}</td>
					            <td>{{ucfirst($student->reporting_teacher)}}</td>
					            <td>
					                <a href="{{ route('students.edit',$student->id)}}" class="btn btn-primary btn-sm">Edit</a>
					            </td> 
					            <td>
					                <form action="{{ route('students.destroy', $student->id)}}" method="post">
					                  @csrf
					                  @method('DELETE')
					                  <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" type="submit">Delete</button>
					                </form>
					            </td> 
					        </tr>
					        @endforeach
					    </tbody>
					    @endif
					  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style type="text/css">
	
		

		#student-table td, #student-table th {
		  border: 1px solid #ddd;
		  padding: 8px;
		}

		#student-table th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: #6c757d;
		  color: white;
		}

</style>