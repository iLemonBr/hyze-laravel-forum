@extends('layouts.chatter')

@section('content')
    {{ Breadcrumbs::render('chatter.forum', $forum) }}

    <create-thread-view :forum='@json($forum)'></create-thread-view>
@stop
