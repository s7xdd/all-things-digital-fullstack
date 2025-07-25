@extends('layouts.app')

@section('title', 'About Us - ' . env('APP_NAME'))
@section('content')

    <x-hero title="{{ $page->getTranslation('title', $lang) }}" subtitle="{{ $page->getTranslation('title1', $lang) }}"
        :page="$page" />

    @include('sections.about.about-dec')

    @include('sections.about.mission-story')

    @include('sections.about.cta')

@endsection
a
