@extends('layouts.user')
@section('content')
<news-component :index_words='@json($index_words)'></news-component>
@endsection