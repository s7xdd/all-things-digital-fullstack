@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">Edit {{ $page->slug }} Page Information</h1>
            </div>
        </div>
    </div>
    <div class="card">
        {{-- <ul class="nav nav-tabs nav-fill border-light">
            @foreach (\App\Models\Language::all() as $key => $language)
                <li class="nav-item">
                    <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('custom-pages.edit', ['id'=>$page->type, 'lang'=> $language->code] ) }}">
                        <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                        <span>{{$language->name}}</span>
                    </a>
                </li>
            @endforeach
        </ul> --}}

        <form class="p-4" action="{{ route('custom-pages.update', $page->id) }}" method="POST" enctype="multipart/form-data"
            onsubmit="return encodeValues()">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name='lang' value="{{ $lang }}">
            <input type="hidden" name="heading1" id="heading1_encoded">

            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">Page Content</h6>
            </div>
            <div class="card-body px-0">

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title <span class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter.." name="title"
                            value="{{ $page->getTranslation('title', $lang) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Subtitle</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter.." name="title1"
                            value="{{ $page->getTranslation('title1', $lang) }}" required>
                    </div>
                </div>


                <div class="form-group row">
                    <h5 class="mb-0 ml-3">About Section</h5>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">
                        Icon
                    </label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    Browse
                                </div>
                            </div>
                            <div class="form-control file-amount">Choose File</div>
                            <input value="{{ old('image5', $page->image5) }}" type="hidden" name="image5"
                                class="selected-files" required>
                        </div>
                        <div class="file-preview box sm">
                        </div>
                        @error('image5')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">
                        Background Image
                    </label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    Browse
                                </div>
                            </div>
                            <div class="form-control file-amount">Choose File</div>
                            <input value="{{ old('image6', $page->image6) }}" type="hidden" name="image6"
                                class="selected-files" required>
                        </div>
                        <div class="file-preview box sm">
                        </div>
                        @error('image6')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter.." name="title2"
                            value="{{ $page->getTranslation('title2', $lang) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.content') }}</label>
                    <div class="col-sm-10">
                        <textarea class=" form-control" placeholder="Enter.." name="content" rows="5" required>{!! $page->getTranslation('content', $lang) !!}</textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label">{{ trans('messages.tags') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control aiz-tag-input" name="title3"
                            placeholder="{{ trans('messages.type_hit_enter_add_tag') }}"
                            value="{{ $page->getTranslation('title3', $lang) }}">
                    </div>
                </div>



                <div class="form-group row">
                    <h5 class="mb-0 ml-3">Our Mission/Vision Section</h5>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.heading') }} <span
                            class="text-danger">*</span> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter.." name="heading2"
                            value="{{ $page->getTranslation('heading2', $lang) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.content') }} <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class=" form-control" placeholder="Enter.." name="content1" rows="5" required>{!! $page->getTranslation('content1', $lang) !!}</textarea>
                    </div>
                </div>



                @php
                    $ourMission = json_decode($page->getTranslation('heading1', $lang), true) ?? [];
                @endphp

                @for ($i = 0; $i < 2; $i++)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title {{ $i + 1 }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control ourMission-title" placeholder="Enter title"
                                value="{{ $ourMission[$i]['title'] ?? '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description {{ $i + 1 }}</label>
                        <div class="col-sm-10">
                            <textarea class="aiz-text-editor ourMission-description" data-min-height="300" name="description">{{ $ourMission[$i]['description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="ourMission{{ $i }}">Image
                            {{ $i + 1 }}</label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                </div>
                                <div class="form-control file-amount">Choose File</div>
                                <input value="{{ $ourMission[$i]['image'] ?? '' }}" type="hidden"
                                    class="selected-files ourMission-image" id="ourMission{{ $i }}">
                            </div>
                            <div class="file-preview box sm"></div>
                        </div>
                    </div>
                    <hr>
                @endfor




                <div class="form-group row">
                    <h5 class="mb-0 ml-3">Contact Section</h5>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.heading') }} </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter.." name="heading4"
                            value="{{ $page->getTranslation('heading4', $lang) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.content') }} <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="content2" placeholder="{{ trans('messages.content') }}" rows="5">{!! $page->getTranslation('content2', $lang) !!}</textarea>
                    </div>
                </div>

                <hr>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">Button Text<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Enter.." name="heading5"
                            value="{{ old('heading5', $page->getTranslation('heading5', $lang)) }}" required>
                    </div>
                </div>

            </div>

            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">Seo Fields</h6>
            </div>
            <div class="card-body px-0">

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_title') }}</label>
                    <div class="col-sm-10">
                        <input type="text" @if ($lang == 'ae') dir="rtl" @endif class="form-control"
                            placeholder="{{ trans('messages.meta_title') }}" name="meta_title"
                            value="{{ $page->getTranslation('meta_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label"
                        for="name">{{ trans('messages.meta_description') }}</label>
                    <div class="col-sm-10">
                        <textarea @if ($lang == 'ae') dir="rtl" @endif class="resize-off form-control"
                            placeholder="{{ trans('messages.meta_description') }}" rows="5" name="meta_description">{!! $page->getTranslation('meta_description', $lang) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.meta_keywords') }}</label>
                    <div class="col-sm-10">
                        <textarea @if ($lang == 'ae') dir="rtl" @endif class="resize-off form-control"
                            placeholder="{{ trans('messages.meta_keywords') }}" rows="3" name="keywords">{!! $page->getTranslation('keywords', $lang) !!}</textarea>
                        <small class="text-muted">Separate with coma</small>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.og_title') }}</label>
                    <div class="col-sm-10">
                        <input type="text" @if ($lang == 'ae') dir="rtl" @endif class="form-control"
                            placeholder="{{ trans('messages.og_title') }}" name="og_title"
                            value="{{ $page->getTranslation('og_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.og_description') }}</label>
                    <div class="col-sm-10">
                        <textarea @if ($lang == 'ae') dir="rtl" @endif class="resize-off form-control"
                            placeholder="{{ trans('messages.og_description') }}" rows="5" name="og_description">{!! $page->getTranslation('og_description', $lang) !!}</textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ trans('messages.twitter_title') }}</label>
                    <div class="col-sm-10">
                        <input type="text" @if ($lang == 'ae') dir="rtl" @endif class="form-control"
                            placeholder="{{ trans('messages.twitter_title') }}" name="twitter_title"
                            value="{{ $page->getTranslation('twitter_title', $lang) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label"
                        for="name">{{ trans('messages.twitter_description') }}</label>
                    <div class="col-sm-10">
                        <textarea @if ($lang == 'ae') dir="rtl" rows="5" @endif class="resize-off form-control"
                            placeholder="{{ trans('messages.twitter_description') }}" name="twitter_description">{!! $page->getTranslation('twitter_description', $lang) !!}</textarea>
                    </div>
                </div>


                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update Page</button>
                    <a href="{{ route('website.pages') }}" class="btn btn-cancel">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var lang = '{{ $lang }}';

            if (lang == 'ae') {
                setEditorDirection(true);
            } else {
                setEditorDirection(false);
            }

            function setEditorDirection(isRtl) {
                const editor = $('.aiz-text-editor').next('.note-editor').find('.note-editable');
                editor.attr('dir', isRtl ? 'rtl' : 'ltr'); // Set direction
                editor.css('text-align', isRtl ? 'right' : 'left');
            }
        });
    </script>

    <script>
        document.querySelector('input[name="image"]').addEventListener('change', function(event) {
            const fileInput = event.target;
            const previewBox = fileInput.closest('.form-group').querySelector('.file-preview');
            const files = fileInput.files;

            if (files && files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewBox.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mt-2 file-preview-item">
                        <div class="align-items-center align-self-stretch d-flex justify-content-center thumb">
                            <img src="${e.target.result}" class="img-fit">
                        </div>
                    </div>
                `;
                }
                reader.readAsDataURL(files[0]);
            }
        });


        function encodeValues() {
            let members = [];

            $('.ourMission-title').each(function(index) {
                const title = $(this).val();
                const description = $('.ourMission-description').eq(index).val();
                const image = $('.ourMission-image').eq(index).val();

                if (title || description || image) {
                    members.push({
                        title,
                        description,
                        image
                    });
                }
            });

            $('#heading1_encoded').val(JSON.stringify(members));
            return true;
        }
    </script>
@endsection
