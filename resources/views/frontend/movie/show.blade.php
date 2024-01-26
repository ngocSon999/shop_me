@extends('frontend.layouts.master')
@section('title', 'Chi tiết - ' . $movie->name)
@section('content')
    <h1>{{ $movie->name }}</h1>
@endsection
