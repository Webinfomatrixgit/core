@extends('frontend.user.article.use')
@section('title', __('Article'))
@section('user-article-content')
    <form action="{{ route('user.article.editb') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h2 class="mb-4"> {{ __('Edit Article') }}</h2>
            <div class="mb-3">
                <label class="form-label" for="category">{{ __('Cateory') }}</label>
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
            <div class="mb-3" style="display:none;">
                <label class="form-label" for="id">{{ __('Id') }}</label>
                <input type="text" name="id" id="id" class="form-control" placeholder="{{ __('id') }}" value = "{{ $article->id }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="title">{{ __('Title') }}</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" value = "{{ $article->title }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta_title">{{ __('Meta Title') }}</label>
                <input type="text-area" name="meta_title" id="meta_title" class="form-control" placeholder="{{ __('Meta Title') }}" value = "{{ $article->meta_title }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">{{ __('Description') }}</label>
                <textarea id="description" name="description" rows="4" cols="50" placeholder="Enter your text here..." value = "{{ $article->description }}" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta_description">{{ __('Meta Description') }}</label>
                <textarea id="meta_description" name="meta_description" rows="4" cols="50" placeholder="Enter your text here..." value = "{{ $article->meta_description }}" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="content">{{ __('Content') }}</label>
                <textarea id="content" name="content" rows="4" cols="50" placeholder="Enter your text here..." value = "{{ $article->content }}"  required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta_keywords">{{ __('Meta Keywords') }}</label>
                <input type="" name="meta_keywords" id="meta_keywords" class="form-control" placeholder="{{ __('') }}" value = "{{ $article->meta_keywords }}"  required>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <x-icon name="check" height="20" class="me-1"/> {{ __('Save') }}
                </button>
            </div>
        </div>
    </form>
@endsection