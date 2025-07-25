@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-10 mx-auto">
            <h4 class="fw-600">Home Page Settings</h4>

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
                <div class="card-header">
                    <h5 class="mb-0">Hero Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="types[]" value="home_categories">
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="title"
                                    value="{{ old('title', $page->getTranslation('title', $lang)) }}" required>
                                <span style="font-size:12px;color: #00b3ff !important;">To highlight specific words, enclose
                                    them in square brackets [ ]</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="sub_title"
                                    value="{{ old('sub_title', $page->getTranslation('sub_title', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button 1 Text<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="heading1"
                                    value="{{ old('heading1', $page->getTranslation('heading1', $lang)) }}" required>
                                <span style="font-size:12px;color: #00b3ff !important;">To highlight specific words, enclose
                                    them in square brackets [ ]</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button 2 Text <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="heading2"
                                    value="{{ old('heading2', $page->getTranslation('heading2', $lang)) }}" required>
                            </div>
                        </div>



                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">About section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" onsubmit="return encodeStats()" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        <input type="hidden" name="heading10" id="heading10_encoded">

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="heading5"
                                    value="{{ old('heading5', $page->getTranslation('heading5', $lang)) }}" required>
                                <span style="font-size:12px;color: #00b3ff !important;">To highlight specific words,
                                    enclose them in square brackets [ ]</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="heading6"
                                    value="{{ old('heading6', $page->getTranslation('heading6', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button Title<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="title1"
                                    value="{{ old('title1', $page->getTranslation('title1', $lang)) }}" required>
                            </div>
                        </div>

                        @php
                            $stats = json_decode($page->getTranslation('heading10', $lang), true) ?? [];
                        @endphp

                        @for ($i = 0; $i < 4; $i++)
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Stat Title {{ $i + 1 }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control team-title" placeholder="Enter title"
                                        value="{{ $stats[$i]['title'] ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Stat Description {{ $i + 1 }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control team-designation"
                                        placeholder="Enter Description" value="{{ $stats[$i]['description'] ?? '' }}">
                                </div>
                            </div>

                            <hr>
                        @endfor

                        <hr>
                        <div class="text-right">
                            <input type="hidden" name="page_type" value="highlights_section">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Clients Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="title2"
                                    value="{{ old('title2', $page->getTranslation('title2', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Services</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="heading3"
                                    value="{{ old('heading3', $page->getTranslation('heading3', $lang)) }}" required>
                                <span style="font-size:12px;color: #00b3ff !important;">To highlight specific words,
                                    enclose them in square brackets [ ]</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="heading4"
                                    value="{{ old('heading4', $page->getTranslation('heading4', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button Text<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="heading8"
                                    value="{{ old('heading8', $page->getTranslation('heading8', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label class="col-md-2 col-from-label">Services (Max 6)</label>
                            <div class="col-md-10">
                                <input type="hidden" name="types[]" value="home_services">
                                <input type="hidden" name="page_type" value="home_services">
                                <select name="home_services[]" class="form-control aiz-selectpicker" multiple
                                    data-max-options="6" data-live-search="true" title="Select Services"
                                    data-selected="{{ get_setting('home_services') }}">
                                    @foreach ($services as $serv)
                                        <option value="{{ $serv->id }}">{{ $serv->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>



            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Why Choose Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data"
                        onsubmit="return encodeWhyChoose()">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        <input type="hidden" name="content1" id="content1_encoded">


                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="heading9"
                                    value="{{ old('heading9', $page->getTranslation('heading9', $lang)) }}" required>
                                <span style="font-size:12px;color: #00b3ff !important;">To highlight specific words,
                                    enclose them in square brackets [ ]</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Subtitle<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="content5"
                                    value="{{ old('content5', $page->getTranslation('content5', $lang)) }}" required>
                            </div>
                        </div>



                        @php
                            $whyChoose = json_decode($page->getTranslation('content1', $lang), true) ?? [];
                        @endphp

                        @for ($i = 0; $i < 3; $i++)
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="whyChooseImage{{ $i }}">Image
                                    {{ $i + 1 }}</label>
                                <div class="col-md-10">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                        </div>
                                        <div class="form-control file-amount">Choose File</div>
                                        <input value="{{ $whyChoose[$i]['image'] ?? '' }}" type="hidden"
                                            class="selected-files whyChoose-image" id="whyChooseImage{{ $i }}">
                                    </div>
                                    <div class="file-preview box sm"></div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title {{ $i + 1 }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control whyChoose-title" placeholder="Enter title"
                                        value="{{ $whyChoose[$i]['title'] ?? '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description {{ $i + 1 }}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control whyChoose-description"
                                        placeholder="Enter Description"
                                        value="{{ $whyChoose[$i]['description'] ?? '' }}">
                                </div>
                            </div>

                            <hr>
                        @endfor




                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Contact Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{ $page_id }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Title<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="content"
                                    value="{{ old('content', $page->getTranslation('content', $lang)) }}" required>
                                <span style="font-size:12px;color: #00b3ff !important;">To highlight specific words,
                                    enclose them in square brackets [ ]</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Content <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content2" placeholder="Enter.." rows="3">{!! $page->getTranslation('content2', $lang) !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">Button Text<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter.." name="title3"
                                    value="{{ old('title3', $page->getTranslation('title3', $lang)) }}" required>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">


                <form class="p-4" action="{{ route('business_settings.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="page_id" value="{{ $page_id }}">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    <div class="card-header px-0">
                        <h6 class="fw-600 mb-0">Seo Fields</h6>
                    </div>
                    <div class="card-body px-0">

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label"
                                for="name">{{ trans('messages.meta_title') }}</label>
                            <div class="col-sm-10">
                                <input type="text" @if ($lang == 'ae') dir="rtl" @endif
                                    class="form-control" placeholder="{{ trans('messages.meta_title') }}"
                                    name="meta_title" value="{{ $page->getTranslation('meta_title', $lang) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label"
                                for="name">{{ trans('messages.meta_description') }}</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="{{ trans('messages.meta_description') }}"
                                    name="meta_description" @if ($lang == 'ae') dir="rtl" @endif>{!! $page->getTranslation('meta_description', $lang) !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label"
                                for="name">{{ trans('messages.meta_keywords') }}</label>
                            <div class="col-sm-10">
                                <textarea @if ($lang == 'ae') dir="rtl" @endif class="resize-off form-control"
                                    placeholder="{{ trans('messages.meta_keywords') }}" name="keywords">{!! $page->getTranslation('keywords', $lang) !!}</textarea>
                                <small class="text-muted">Separate with coma</small>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label"
                                for="name">{{ trans('messages.og_title') }}</label>
                            <div class="col-sm-10">
                                <input type="text" @if ($lang == 'ae') dir="rtl" @endif
                                    class="form-control" placeholder="{{ trans('messages.og_title') }}" name="og_title"
                                    value="{{ $page->getTranslation('og_title', $lang) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label"
                                for="name">{{ trans('messages.og_description') }}</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="{{ trans('messages.og_description') }}" name="og_description"
                                    @if ($lang == 'ae') dir="rtl" @endif>{!! $page->getTranslation('og_description', $lang) !!}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label"
                                for="name">{{ trans('messages.twitter_title') }}</label>
                            <div class="col-sm-10">
                                <input type="text" @if ($lang == 'ae') dir="rtl" @endif
                                    class="form-control" placeholder="{{ trans('messages.twitter_title') }}"
                                    name="twitter_title" value="{{ $page->getTranslation('twitter_title', $lang) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label"
                                for="name">{{ trans('messages.twitter_description') }}</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="{{ trans('messages.twitter_description') }}"
                                    name="twitter_description" @if ($lang == 'ae') dir="rtl" @endif>{!! $page->getTranslation('twitter_description', $lang) !!}</textarea>
                            </div>
                        </div>



                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update</button>
                            <a href="{{ route('website.pages') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            AIZ.plugins.bootstrapSelect('refresh');

            $('.aiz-selectpicker').on('shown.bs.select', function() {
                var select = $(this);
                var selectedOptions = select.find('option:selected').detach();
                select.prepend(selectedOptions);
                select.selectpicker('refresh');
            });
        });

        $('.remove-galley').on('click', function() {
            thumbnail = $(this)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{ route('page.delete_image') }}',
                data: {
                    url: $(thumbnail).data('url'),
                    id: '{{ $page->id }}'
                },
                success: function(data) {
                    if (data == 1) {
                        $(thumbnail).closest('.file-preview-item').remove();
                        AIZ.plugins.notify('success',
                            "{{ trans('messages.image') . trans('messages.deleted_msg') }}");
                    } else {
                        AIZ.plugins.notify('danger', "{{ trans('messages.something_went_wrong') }}");
                    }

                }
            });
        });
    </script>

    <script>
        function encodeStats() {
            let members = [];

            $('.team-title').each(function(index) {
                const title = $(this).val();
                const description = $('.team-designation').eq(index).val();

                if (title || description) {
                    members.push({
                        title,
                        description,
                    });
                }
            });

            $('#heading10_encoded').val(JSON.stringify(members));
            return true;
        }

        function encodeWhyChoose() {
            let members = [];

            $('.whyChoose-title').each(function(index) {
                const title = $(this).val();
                const description = $('.whyChoose-description').eq(index).val();
                const image = $('.whyChoose-image').eq(index).val();

                if (title || description || image) {
                    members.push({
                        title,
                        description,
                        image
                    });
                }
            });

            $('#content1_encoded').val(JSON.stringify(members));
            return true;
        }
    </script>
@endsection
