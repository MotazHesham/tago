@extends('layouts.company')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard 
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-white bg-success">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ $num_of_users }}</div>
                                    <div>الموظفين</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-white bg-info">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ $package->num_of_users }}</div>
                                    <div>عدد الكروت المتاحة</div>
                                    <br />
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts') 