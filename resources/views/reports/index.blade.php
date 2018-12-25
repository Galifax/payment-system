@extends('layouts.app')

@section('content')
<div class="container">
    <report :data="{{ json_encode($model) }}"/>
</div>
@endsection
