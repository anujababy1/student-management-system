@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  Students marks
                  <a  href="{{ route('marks.create')}}" class="btn btn-primary btn-sm" style="float: right;">Add mark</a>
              </div>

                <div class="card-body">

                   @if(session()->get('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}  
              </div>
            @endif  
              <table id="mark-table" class="table">
        @if(count($marks)==0)
          <p style="text-align:center;">No results found</p>
        @else
        <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Science</th>
          <th>Maths</th>
          <th>History</th>
          <th>Term</th>
          <th>Total Marks</th>
          <th>Created On</th>
          <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($marks as $mark)
        <tr>
            <td>{{$mark->id}}</td>
            <td>{{$mark->student->name}}</td>
            <td>{{$mark->science}}</td>
            <td>{{$mark->maths}}</td>            
            <td>{{$mark->history}}</td>
            <td>{{ucfirst($mark->term)}}</td>
            <td>{{$mark->total_marks}}</td>
            <td>{{ \Carbon\Carbon::parse($mark->created_at)->isoFormat('MMM Do YYYY h:mm a')}}</td>
            <td>
                <a href="{{ route('marks.edit',$mark->id)}}" class="btn btn-primary btn-sm">Edit</a>
            </td>
            <td>
                <form action="{{ route('marks.destroy', $mark->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to do this?')" type="submit">Delete</button>
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
  
    

    #mark-table td, #mark-table th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #mark-table th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #6c757d;
      color: white;
    }

</style>