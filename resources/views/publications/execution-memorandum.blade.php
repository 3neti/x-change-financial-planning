@extends('publications.layout')

@section('content')
    <section class="cover-page">
        <div class="cover-page__inner">
            <h1 class="cover-page__title">{{ $title }}</h1>
            <p class="cover-page__subject">{{ $subject }}</p>

            <div class="cover-page__meta">
                <p>Prepared for {{ $preparedFor }}</p>
                <p>Prepared by {{ $preparedBy }}</p>
            </div>

            <p class="cover-page__year">{{ $publicationYear }}</p>
        </div>
    </section>

    <article class="manuscript">
        {!! $manuscriptHtml !!}
    </article>
@endsection
