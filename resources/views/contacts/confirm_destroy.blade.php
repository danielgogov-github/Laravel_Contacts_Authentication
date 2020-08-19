@extends('base')

@section('content')
    <p class="text-center">Are you sure you want to delete <span class="font-weight-bold">{{ $contact->first_name }} {{ $contact->last_name }}</span> ?</p>

    {!! Form::open(['action' => ['ContactsController@destroy', $contact->id], 'class' => 'text-center']) !!}
    <div class="form-group">
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Yes', ['class' => 'btn btn-danger']) }}
        <button class="btn btn-dark"><a href="{{ url('/contacts') }}" class="text-decoration-none text-light">No</a></button>
    </div>
    {!! Form::close() !!}
@endsection
