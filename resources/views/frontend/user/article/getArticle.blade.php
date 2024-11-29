@extends('frontend.user.article.use')
@section('title', __('Article'))
@section('user-article-content')
    <div class="card border-0 mb-4">
        <div class="card-body px-2">
            <div class="table-responsive rounded mb-3">
                <table class="table card-table table-vcenter text-nowrap mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>{{ __('id') }}</th>
                        <th>{{ __('Press Release Name') }}</th>
                        <th>{{ __('content') }}</th>
                        <th>{{ __('description') }}</th>
                        <th>{{ __('alt tag') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($article as $item) <!-- Loop through each article -->
                        <tr>
                            <td>{{ $item->id }}</td> <!-- Display the article ID -->
                            <td>{{ $item->title }}</td> <!-- Display the article title -->
                            <td>{{ $item->content }}</td> <!-- Display the article content -->
                            <td>{{ $item->description ?? 'N/A' }}</td> <!-- Display the description, if available -->
                            <td>{{ $item->alt_tag}}</td> <!-- Display the alt tag, if available -->
                            <td style="width:85px;">
                                <button class="btn btn-warning btn-xs btn-detail open_modal bold uppercase editArticle" data-id = "{{ $item->id }}">
                                    <i class="fa fa-edit co-white"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs btn-detail open_modal bold uppercase deleteArticle"  data-toggle="modal" data-target="#DelModal" data-id="{{ $item->id }}">
                                    <i class="fa fa-trash co-white"></i> 
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.editArticle').on('click', function() {
            var articleId = $(this).data('id');
            if (articleId) {
                // Redirect the user to the edit page using window.location
                window.location.href = '{{ route("user.article.edit", ":id") }}'.replace(':id', articleId);
            } else {
                alert('Invalid article ID');
            }
        });
        $('.deleteArticle').on('click', function() {
            var articleId = $(this).data('id');
            if (articleId) {
                // Redirect the user to the edit page using window.location
                window.location.href = '{{ route("user.article.delete", ":id") }}'.replace(':id', articleId);
            } else {
                alert('Invalid article ID');
            }
        });
    });
</script>





@endsection





