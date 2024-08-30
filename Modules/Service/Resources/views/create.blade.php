@extends('backend.partials.master')
@section('title')
    {{ __('service') }} {{ __('create') }}
@endsection

@section('breadcrumb')
    <div class="breadcrumb-area">
        <h5 class="title text--base m-0">{{ __('services') }}</h5>
        <ul class="breadcrumb">
            <li> <a href="{{ route('services.index') }}">{{ __('services') }}</a> </li>
            <li>  {{ __('create') }} </li>
        </ul>
    </div>
@endsection

@section('maincontent')
    <div class="user-panel-wrapper">
        <div class="user-panel-content">
            <div class="row g-4">
                <div class="col-xl-12">
                    <div class="dashboard--widget ">
                        <h4 class="card-title overflow-hidden"> 

                            <a href="{{ route('services.index') }}" class="btn btn-sm btn-primary float-right" data-bs-toggle="tooltip" title="{{ __('back') }}"
                            data-bs-placement="top">
                                <i class="fa fa-arrow-left"></i> {{ __('back') }}
                            </a>
                        </h4>
                        <form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">  
                                
                                    <div class="col-lg-6  ">
                                        <label for="name" class="form-label">{{ __('name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control form--control" id="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="text-danger pt-2">{{ $message }}</p>
                                        @enderror
                                    </div>  

                                    <div class="col-lg-6 @if(isSuperadmin()) mt-3 @endif">
                                        <label for="position" class="form-label">{{ __('position') }}  </label>
                                        <input type="text" name="position" class="form-control form--control" id="position" value="{{ old('position') }}">
                                        @error('position')
                                            <p class="text-danger pt-2">{{ $message }}</p>
                                        @enderror
                                    </div>  

                                    <div class="col-lg-6 mt-3">
                                        <label for="name" class="form-label">{{ __('price') }}  <span class="text-danger">*</span> </label>
                                        <input type="number" name="price" class="form-control form--control" />
                                    </div>  
                                    <div class="col-lg-12 mt-3">
                                        <label for="name" class="form-label">{{ __('description') }}  </label>
                                        <textarea class="form-control form--control" name="description">{{ old('description') }}</textarea>
                                    </div>  

                                    <div class="col-lg-3   mt-4 pt-lg-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex mt-3">
                                                    <label class="form-label cmr-10">{{ __('status') }}</label>
                                                    <input type="checkbox" class="status" id="status" switch="success" name="status" {{ old('status',\App\Enums\Status::ACTIVE) == \App\Enums\Status::INACTIVE? '':'checked' }} >
                                                    <label for="status" data-on-label="{{ __('status.'.App\Enums\Status::ACTIVE) }}" data-off-label="{{ __('status.'.App\Enums\Status::INACTIVE) }}"></label>
                                                </div>
                                            </div> 
                                        </div>
                                    </div> 
                                    <div class="col-12 mt-5  text-end">
                                        <button type="submit" class="btn submit-btn btn-primary btn-sm"> <i class="fa fa-save"></i> {{__('save')}}</button>
                                    </div> 
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 