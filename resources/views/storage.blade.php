@extends('layouts.user')
@section('content')
<storage-component :folders="{{$folders}}"></storage-component>
@endsection