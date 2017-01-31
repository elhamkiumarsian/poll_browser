@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection

@section('content')
    <div class="container conten-body">

    {!!  Form::open(array('id'=>'poll_form')) !!}
        <div class="form-group row">
        {!! Form::label('name', 'Your Name:',['class'=>'col-sm-2 form-control-label'])!!}
            <div class="col-sm-5">
        {!! Form::text('name','',['class'=>'form-control']) !!}
            </div>
            </div>
        <div class="form-group row">
        {!! Form::label('email','Your E-mail:',['class'=>'col-sm-2 form-control-label']) !!}
            <div class="col-sm-5">
            {!! Form::email('email',null,['class'=>'form-control']) !!}
                </div>
            </div>
        <div class="form-group row">
        <label class="col-sm-2 form-control-label">Favorite Browser</label>
            <div class="col-sm-5">
        {!! Form::select('favorite_browser_code', $browsers,'',['class'=>'form-control']) !!}
            </div>
            </div>
        <div class="form-group row">
        {!! Form::label('reason','Your reason:',['class'=>'col-sm-2 form-control-label']) !!}
            <div class="col-sm-5">
            {!! Form::textarea('reason',null,['class'=>'form-control','rows'=>4]) !!}
            </div>
            </div>

        <div class="col-sm-3 col-sm-offset-3" >
        {!! Form::submit('Submit',['class'=>'btn btn-default btn-block']) !!}
        </div>

    {!! Form::close() !!}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 " >
           <a href="{{url('/Stat')}}" class="btn btn-success btn-block belowsubmit">See the results</a>
                </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript" src="{{asset('javascript/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('javascript/jquery.validate.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $.validator.addMethod('makeSureSelect',function(value,element){
                if(value==0){
                    return false;
                }else {
                    return true;
                }
            },'mate,you need to select one browser');
            $('#poll_form').validate({
                errorElement: "div",
                rules:{
                    name:{
                        required: true,
                        minlength: 2
                    },
                    email:{
                        required:true,
                        email:true
                    },
                    favorite_browser_code:'makeSureSelect'
                    ,
                    reason:{
                        required:true,
                        minlength: 10
                    }
                },
                messages:{
                    name:{
                        required: "This field can't be empty",
                        minlength: "Min length is 2"
                    },
                    email:{
                        required: "E-mail must be filled out, mate",
                        email:"Mate, is it an email?"
                    },
                    reason:{
                        required:"Please express your reason",
                        minlength:"Not less than 10 characters"
                    }
                },
                highlight:function(element, errorClass, validClass) {
                    $(element).addClass(errorClass).removeClass(validClass);
                },
                errorPlacement:function(error,element){
                    error.insertAfter(element);
                },
                submitHandler:function(form){
                    //console.log('ok');
                    form.submit();
                }
            });
        });
    </script>
@stop