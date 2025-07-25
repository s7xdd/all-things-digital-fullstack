@extends('layouts.app')

@section('title', 'Home - ' . env('APP_NAME'))

@section('content')
    @include('sections.home.hero')

    @include('sections.home.about')

    @include('sections.home.industry-leaders')

    @include('sections.home.services')

    @include('sections.home.why-choose')

    @include('sections.home.cta')

@endsection
