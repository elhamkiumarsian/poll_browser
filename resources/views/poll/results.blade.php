@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <h3 class="text-center"> Overall Results</h3>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>Browser Name</th>
            <th>Number of Votes</th>
            <th>Vote Percentage</th>
        </tr>
    @foreach($hits as $browser=>$data)
        <tr>
            <td>{{$browser}}</td>
            <td>{{$data['votes']}}</td>
            <td>{{$data['votesPercent']}}</td>
        </tr>
    @endforeach
        </tbody>
    </table>
        </div>
</div>
    <hr>
<div class="container">
    <div class="row">
        <h3 class="text-center">Previous Comments</h3>
    <table class="table table-responsive">
        <tbody>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Favorite Browser</th>
            <th>Reason</th>
            <th>Time Submitted</th>
        </tr>

        @foreach($allVotes as $vote)
            <tr>
                <td>{{($vote->name)}}</td>
                <td>{{$vote->email}}</td>
                <td>{{$browsers[$vote->favorite_browser_code]}}</td>
                <td>{{$vote->reason}}</td>
                <td>{{$vote->updated_at->format('D, d-M-Y , H:i:s')}}</td>
            </tr>
            @endforeach
            </tbody>
    </table>
        <a href="{{url('/Poll')}}" class="btn btn-info">Back to Voting form</a>
        </div>
    </div>

@endsection
@section('javascript')
@section('javascript')
    <script type="text/javascript" src="{{asset('javascript/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('javascript/bootstrap.min.js')}}"></script>

@stop