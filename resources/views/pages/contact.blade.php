@extends('layout.master')
@section('title','contact')
@section('content')
<h1>{{$page_name}}</h1>
<p>{{$page_description}}</p>
@endsection
@section('slidbar')
@parent
this is Slidbar from contact
@endsection

