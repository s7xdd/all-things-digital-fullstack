@extends('backend.layouts.app')

@section('content')
    <style>
        .remove-attachment {
            display: none;
        }
    </style>

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h4">{{ trans('messages.service') . ' ' . trans('messages.information') }}</h5>
    </div>

    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <form id="dynamic-field-form-1" class="p-4" action="{{ route('service.update', $service->id) }}"
                    method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    <input type="hidden" name="custom_fields" id="custom_fields">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ trans('messages.name') }} <i
                                class="las la-language text-danger"
                                title="{{ trans('messages.translatable') }}"></i></label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{ $service->getTranslation('name', $lang) }}"
                                class="form-control" id="name" onchange="title_update(this)"
                                placeholder="{{ trans('messages.name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ trans('messages.slug') }}<span
                                class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="text" placeholder="{{ trans('messages.slug') }}" id="slug" name="slug"
                                class="form-control" value="{{ $service->slug }}">
                            @error('slug')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">Icon</label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ trans('messages.browse') }}
                                    </div>
                                </div>
                                <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                <input type="hidden" name="icon" value="{{ $service->icon }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Short Description <i class="las la-language text-danger"
                                title="{{ trans('messages.translatable') }}"></i></label>
                        <div class="col-md-9">
                            <input type="text" name="short_description"
                                value="{{ $service->getTranslation('short_description', $lang) }}" class="form-control"
                                id="name" placeholder="Short Description">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ trans('messages.description') }}</label>
                        <div class="col-md-9">
                            <textarea class="aiz-text-editor" data-min-height="300" name="description">{{ old('description', $service->getTranslation('description', $lang)) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ trans('messages.description') }} 1</label>
                        <div class="col-md-9">
                            <textarea class="aiz-text-editor" data-min-height="300" name="description_1">{{ old('description_1', $service->getTranslation('description_1', $lang)) }}</textarea>
                        </div>
                    </div>

                    <h5 class="mb-0 h6">Features</h5>
                    <hr>

                    @for ($i = 1; $i <= 6; $i++)
                        <div class="form-group d-flex flex-wrap">
                            <div class="col-md-4 mb-2">
                                <label class="col-form-label">Title {{ $i }}</label>
                                <input type="text" placeholder="Title {{ $i }}"
                                    id="title{{ $i }}" name="title{{ $i }}"
                                    value="{{ $service->getTranslation('feature_title_' . $i, $lang) }}"
                                    class="form-control">
                                @error('title{{ $i }}')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="col-form-label">Content {{ $i }}</label>
                                <input type="text" placeholder="Content {{ $i }}"
                                    value="{{ $service->getTranslation('feature_content_' . $i, $lang) }}"
                                    id="content{{ $i }}" name="content{{ $i }}"
                                    class="form-control">
                                @error('content{{ $i }}')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="signinSrEmail">Icon {{ $i }}</label>
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ trans('messages.browse') }}
                                        </div>
                                    </div>
                                    <div class="form-control file-amount">{{ trans('messages.choose_file') }}</div>
                                    <input type="hidden" name="icon{{ $i }}"
                                        value="{{ $service->getTranslation('feature_image_' . $i, $lang) }}"
                                        class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>

                        </div>
                    @endfor

                    <hr>

                    <h5 class="mb-3 h6">Common Use Cases</h5>

                    <div id="dynamic-field-container-1">
                        @php
                            $dynamicItems1 = json_decode($service->getTranslation('custom_fields', $lang), true) ?? [];
                        @endphp

                        @foreach ($dynamicItems1 as $item)
                            <div class="country-group mb-3 border p-3 rounded bg-light">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control field-name"
                                        value="{{ $item['name'] ?? '' }}">
                                </div>
                                <button type="button"
                                    class="btn btn-danger btn-sm remove-dynamic-field-1 mt-2">Remove</button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-outline-primary mb-3" id="add-dynamic-field">+ Add
                        Use Case</button>


                    @if ($lang == 'en')
                        <div class="form-group  row">
                            <label class="col-md-3 col-form-label">{{ trans('messages.active_status') }}</label>
                            <div class="col-md-9">
                                <select class="select2 form-control" name="status">
                                    <option {{ old('status', $service->status) == 1 ? 'selected' : '' }} value="1">
                                        {{ trans('messages.yes') }}
                                    </option>
                                    <option {{ old('status', $service->status) == 0 ? 'selected' : '' }} value="0">
                                        {{ trans('messages.no') }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Sort Order</label>
                            <div class="col-md-9">
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $service->sort_order) }}">
                                @error('sort_order')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif



                    <h5 class="mb-0 h6">{{ trans('messages.seo_section') }}</h5>
                    <hr>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="name">{{ trans('messages.meta_title') }}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="meta_title"
                                placeholder="{{ trans('messages.meta_title') }}"
                                value="{{ old('meta_title', $service->getTranslation('meta_title', $lang)) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                            for="name">{{ trans('messages.meta_description') }}</label>
                        <div class="col-md-9">
                            <textarea name="meta_description" rows="5" class="form-control">{{ old('meta_description', $service->getTranslation('meta_description', $lang)) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                            for="name">{{ trans('messages.meta_keywords') }}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="meta_keywords"
                                placeholder="{{ trans('messages.meta_keywords') }}"
                                value="{{ old('meta_keywords', $service->getTranslation('meta_keywords', $lang)) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="name">{{ trans('messages.og_title') }}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="og_title"
                                placeholder="{{ trans('messages.og_title') }}"
                                value="{{ old('og_title', $service->getTranslation('og_title', $lang)) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                            for="name">{{ trans('messages.og_description') }}</label>
                        <div class="col-md-9">
                            <textarea name="og_description" rows="5" class="form-control">{{ old('og_description', $service->getTranslation('og_description', $lang)) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                            for="name">{{ trans('messages.twitter_title') }}</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="twitter_title"
                                placeholder="{{ trans('messages.twitter_title') }}"
                                value="{{ old('twitter_title', $service->getTranslation('twitter_title', $lang)) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"
                            for="name">{{ trans('messages.twitter_description') }}</label>
                        <div class="col-md-9">
                            <textarea name="twitter_description" rows="5" class="form-control">{{ old('twitter_description', $service->getTranslation('twitter_description', $lang)) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ trans('messages.Save') }}</button>
                        <a href="{{ route('service.index') }}" class="btn btn-cancel">{{ trans('messages.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function title_update(e) {
            var title = e.value;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('generate-slug') }}",
                type: 'GET',
                data: {
                    title: title
                },
                success: function(response) {
                    $('#slug').val(response);
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#add-dynamic-field').on('click', function() {
                const item = `
            <div class="country-group mb-3 border p-3 rounded bg-light">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control field-name" value="">
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-dynamic-field-1 mt-2">Remove</button>
            </div>
        `;
                $('#dynamic-field-container-1').append(item);
            });

            $(document).on('click', '.remove-dynamic-field-1', function() {
                $(this).closest('.country-group').remove();
            });

            $('#dynamic-field-form-1').on('submit', function(e) {
                let items = [];
                $('#dynamic-field-container-1 .country-group').each(function() {
                    items.push({
                        name: $(this).find('.field-name').val(),
                    });
                });

                $('#custom_fields').val(JSON.stringify(items));
            });
        });
    </script>
@endsection
