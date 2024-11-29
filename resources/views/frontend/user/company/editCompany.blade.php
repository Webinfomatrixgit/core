@extends('frontend.user.article.use')
@section('title', __('Company'))
@section('user-article-content')
    <form action="{{ route('user.company.editb') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h2 class="mb-4"> {{ __('Edit Company') }}</h2>

            <!-- Name, Slug, Description, Email, Phone, Website fields -->
            <div class="mb-3" style="display:none;">
                <label class="form-label" for="id">{{ __('Id') }}</label>
                <input type="text" name="id" id="id" class="form-control" placeholder="{{ __('id') }}" value = "{{ $company->id }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="name">{{ __('Name') }}</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('') }}" value = "{{ $company->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="slug">{{ __('Slug') }}</label>
                <input type="text" name="slug" id="slug" class="form-control" placeholder="{{ __('Slug') }}" value = "{{ $company->slug }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">{{ __('Description') }}</label>
                <textarea id="description" name="description" rows="4" cols="50" placeholder="Enter your text here..." value = "{{ $company->description }}" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('Email') }}" value = "{{ $company->email }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="phone">{{ __('Phone') }}</label>
                <input type="number" name="phone" id="phone" class="form-control" placeholder="{{ __('Phone') }}" value = "{{ $company->phone }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="website">{{ __('Website') }}</label>
                <input type="text" name="website" id="website" class="form-control" placeholder="{{ __('Website') }}" value = "{{ $company->website }}" required>
            </div>

            <!-- Country Dropdown -->
            <div class="mb-3">
                <label class="form-label" for="country">{{ __('Country') }}</label>
                <select name="country_id" id="country" class="form-control" required>
                    <option value="" disabled selected>{{ __('Select a Country') }}</option>
                    @foreach($data['country'] as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- State Dropdown (Dynamically populated) -->
            <div class="mb-3">
                <label class="form-label" for="state">{{ __('State') }}</label>
                <select name="state_id" id="state" class="form-control" required>
                    <option value="" disabled selected>{{ __('Select a State') }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="city">{{ __('City') }}</label>
                <select name="city_id" id="city" class="form-control" required>
                    <option value="" disabled selected>{{ __('Select a City') }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="logo_url">{{ __('Logo URL') }}</label>
                <input type="url" name="logo_url" id="logo_url" class="form-control" value = "{{ $company->logo_url }}" placeholder="{{ __('Enter the Logo URL') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('Is Active') }}</label>
                <div class="form-check">
                    <input type="radio" name="is_active" id="is_active_true" class="form-check-input" value="1" required>
                    <label class="form-check-label" for="is_active_true">{{ __('True') }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="is_active" id="is_active_false" class="form-check-input" value="0">
                    <label class="form-check-label" for="is_active_false">{{ __('False') }}</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="user_limit">{{ __('User Limit') }}</label>
                <input type="number" name="user_limit" id="user_limit" class="form-control" value = "{{ $company->user_limit }}" placeholder="{{ __('Enter the User Limit') }}" min="0" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="storage_limit">{{ __('Storage Limit') }}</label>
                <input type="number" name="storage_limit" id="storage_limit" class="form-control" value = "{{ $company->storage_limit }}" placeholder="{{ __('Enter the Storage Limit (in MB)') }}" min="0" required>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // When the country dropdown changes
                $('#country').on('change', function() {
                    var countryId = $(this).val();  // Get the selected country ID
                    if(countryId) {
                        // Make an AJAX request to fetch states for the selected country
                        $.ajax({
                            url: '{{ route("user.fetch.state") }}',  // The route that fetches states
                            method: 'GET',
                            data: { country_id: countryId },  // Send the country_id in the request
                            success: function(response) {
                                // Clear the states dropdown and add a default "Select a State" option
                                $('#state').empty();
                                $('#state').append('<option value="" disabled selected>{{ __("Select a State") }}</option>');

                                // Populate the state dropdown with the returned states
                                if(response.states.length > 0) {
                                    $.each(response.states, function(key, state) {
                                        $('#state').append('<option value="' + state.id + '">' + state.name + '</option>');
                                    });
                                } else {
                                    $('#state').append('<option value="" disabled>{{ __("No states available") }}</option>');
                                }
                            },
                            error: function() {
                                alert('Could not fetch states. Please try again.');
                            }
                        });
                    } else {
                        // Clear the state dropdown if no country is selected
                        $('#state').empty();
                        $('#state').append('<option value="" disabled selected>{{ __("Select a State") }}</option>');
                    }
                });
                $('#state').on('change', function() {
                    var stateId = $(this).val();  // Get the selected state ID
                    if (stateId) {
                        // Make an AJAX request to fetch cities for the selected state
                        $.ajax({
                            url: '{{ route("user.fetch.city") }}',  // The route that fetches cities
                            method: 'GET',
                            data: { state_id: stateId },  // Send the state_id in the request
                            success: function(response) {
                                // Clear the cities dropdown and add a default "Select a City" option
                                $('#city').empty();
                                $('#city').append('<option value="" disabled selected>{{ __("Select a City") }}</option>');
                                // Populate the city dropdown with the returned cities
                                if (response.cities && response.cities.length > 0) {
                                    $.each(response.cities, function(index, city) {
                                        $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                                    });
                                } else {
                                    $('#city').append('<option value="" disabled>{{ __("No cities available") }}</option>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching cities:', error);
                                alert('Could not fetch cities. Please try again.');
                            }
                        });
                    } else {
                        // Clear the city dropdown if no state is selected
                        $('#city').empty();
                        $('#city').append('<option value="" disabled selected>{{ __("Select a City") }}</option>');
                    }
                });
            });
        </script>
@endsection
