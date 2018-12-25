@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                 <profile :user="{{ json_encode(Auth::user()) }}" :users="{{ json_encode($users) }}"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
