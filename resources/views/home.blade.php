@extends('layouts.user')
@section('content')
<dashboard-component :users="{{$users}}"></dashboard-component>
@endsection