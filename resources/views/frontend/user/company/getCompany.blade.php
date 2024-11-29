@extends('frontend.user.article.use')
@section('title', __('Company'))
@section('user-article-content')
    <div class="card border-0 mb-4">
        <div class="card-body px-2">
            <div class="table-responsive rounded mb-3">
                <table class="table card-table table-vcenter text-nowrap mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>{{ __('id') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('slug') }}</th>
                        <th>{{ __('description') }}</th>
                        <th>{{ __('email') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $item) 
                        <tr>
                            <td>{{ $item->id }}</td> 
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }}</td> 
                            <td>{{ $item->description ?? 'N/A' }}</td> 
                            <td>{{ $item->email}}</td> 
                            <td style="width:85px;">
                                <button class="btn btn-warning btn-xs btn-detail open_modal bold uppercase editCompany" data-id = "{{ $item->id }}">
                                    <i class="fa fa-edit co-white"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs btn-detail open_modal bold uppercase deleteCompany"  data-toggle="modal" data-target="#DelModal" data-id="{{ $item->id }}">
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
        $('.editCompany').on('click', function() {
            var articleId = $(this).data('id');
            if (articleId) {
                // Redirect the user to the edit page using window.location
                window.location.href = '{{ route("user.company.edit", ":id") }}'.replace(':id', articleId);
            } else {
                alert('Invalid article ID');
            }
        });
        $('.deleteCompany').on('click', function() {
            var companyId = $(this).data('id');
            if (companyId) {
                // Redirect the user to the edit page using window.location
                window.location.href = '{{ route("user.company.delete", ":id") }}'.replace(':id', companyId);
            } else {
                alert('Invalid article ID');
            }
        });
    });
</script>

@endsection





