@extends('layouts.base')

@section('content')
    @include('layouts.tip')
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">添加</h3>
            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 80px;">
                    @ability('superadministrator', 'create-medias')
                        <a href="{{route('medias.index')}}" class="btn-sm btn-info">返回</a>
                    @endability
                </div>
            </div>
        </div>
        <form action="{{route('medias.store')}}" method="post" class="departments-form form-horizontal">
            {{csrf_field()}}
            @include('media.form')
        </form>
    </div>
@endsection



