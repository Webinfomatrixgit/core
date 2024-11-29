@extends('frontend.user.article.use')
@section('title', __('Article'))
@section('user-article-content')
    <form action="{{ route('user.article.add') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h2 class="mb-4"> {{ __('Add Article') }}</h2>
            <div class="mb-3">
                <label class="form-label" for="category">{{ __('Category') }}</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="" disabled selected>{{ __('Select a Category') }}</option>
                    @foreach($data['category'] as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="company">{{ __('Company') }}</label>
                <select name="company" id="company" class="form-control" required>
                    <option value="" disabled selected>{{ __('Select a Company') }}</option>
                    @foreach($data['company'] as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">{{ __('Summary') }}</label>
                <textarea id="description" name="description" rows="4" cols="50" placeholder="Enter your text here..." required></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label" for="content">{{ __('Content') }}</label>
                <textarea id="content" name="content" rows="4" cols="50" placeholder="Enter your text here..." required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="alt_tag">{{ __('Image Title') }}</label>
                <input type="text" name="alt_tag" id="alt_tag" class="form-control" placeholder="{{ __('Image Title') }}" required>
            </div> 
            <div class="mb-3">
                <label class="form-label" for="title">{{ __('Title') }}</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta_title">{{ __('Meta Title') }}</label>
                <input type="text-area" name="meta_title" id="meta_title" class="form-control" placeholder="{{ __('Meta Title') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta_keywords">{{ __('Meta Keywords') }}</label>
                <input type="" name="meta_keywords" id="meta_keywords" class="form-control" placeholder="{{ __('') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta_description">{{ __('Meta Summary') }}</label>
                <textarea id="meta_description" name="meta_description" rows="4" cols="50" placeholder="Enter your text here..." required></textarea>
            </div>
               
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <x-icon name="check" height="20" class="me-1"/> {{ __('Add') }}
                </button>
            </div>
        </div>
    </form>
@endsection