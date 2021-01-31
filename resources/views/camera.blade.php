@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/camera-manage.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div id="camera_manage"></div>
        </div>
    </div>
</div>
@endsection
