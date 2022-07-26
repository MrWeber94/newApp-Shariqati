@extends('dashboard.index')

@section('content')
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>{{ $title }}</h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div>


      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="x_panel">



            @include('dashboard.layouts.messages')


            <div class="x_content">
              <form action="{{ aurl('Events/' . $data[0]->slug) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <span class="section">Edit Events</span>

                <input type="hidden" name="id" value="{{ $data[0]->id }}">
                @foreach ($data[0]->eventDetails as $language)
                  <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align"
                      for="name_{{ $language->language }}">{{ __('admin.name_' . $language->language) }}<span
                        class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                      <input class="form-control" name="name_{{ $language->language }}"
                        value="{{ $language->name }}" id="first_event_name" />
                    </div>
                  </div>

                  <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align"
                      for="details_{{ $language->language }}">{{ __('admin.details_' . $language->language) }}<span
                        class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                      <textarea class="form-control" id="details_{{ $language }}"
                        name="details_{{ $language->language }}">{{ $language->details }}</textarea>
                    </div>
                  </div>
                @endforeach

                <div class="field item form-group">
                  <label class="col-form-label col-md-3 col-sm-3  label-align"
                    for="content_ar">{{ __('admin.event_date') }}<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" name="datetime" class="form-control"
                      value="{{ $data[0]->from . ' ' . $data[0]->from_time . ' - ' . $data[0]->to . ' ' . $data[0]->to_time }}" />
                  </div>
                </div>

                <div class="field item form-group">
                  <label class="col-form-label col-md-3 col-sm-3  label-align"
                    for="content_ar">{{ __('admin.keywords') }}<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6">
                    <textarea style="resize: none;" class="form-control" name="keywords">{{ implode(', ', $keywords) }}</textarea>
                  </div>
                </div>

                <div class="field item form-group">
                  <label class="col-form-label col-md-3 col-sm-3  label-align">{{ __('admin.image') }}</label>
                  <div class="col-md-6 col-sm-6">
                    <input type="file" class="form-control" name='image'>
                  </div>
                </div>

                <div class="field item form-group">
                  <label class="col-form-label col-md-3 col-sm-3  label-align">{{ __('admin.slug') }}</label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control" name='slug' value="{{ $data[0]->slug }}" id="slug"
                      readonly>
                  </div>
                </div>

                <div class="field form-group flex-wrap" id="pointsBox">
                  <label class="col-form-label col-md-3 col-sm-3  label-align">{{ __('admin.points') }}</label>
                  @foreach (json_decode($data[0]->points) as $key => $point)
                    @if ($key == 0)
                      <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name='points[]' value="{{ $point }}">
                        <a id="addPoint" class="btn btn-primary "><i class="fa fa-plus text-white"></i></a>
                      </div>
                    @else
                      <div class="col-12 col-md-6 float-none d-block mx-auto mb-3 position-static">
                        <input type="text" class="form-control mx-auto" name="points[]" value="{{ $point }}">
                      </div>
                    @endif
                  @endforeach
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 offset-md-3">
                    <button type='submit' class="btn btn-primary">{{ __('admin.submit') }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->


  <!-- Include Date Range Picker -->
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

  <script src="https://cdn.ckeditor.com/4.18.0/basic/ckeditor.js"></script>

  {{-- CKEditor --}}
  <script>
    $(document).ready(function() {
      CKEDITOR.replace('content_en');
      CKEDITOR.replace('content_ar');
    });
  </script>

  {{-- Generate Slug --}}
  <script>
    $('#first_event_name').on('keyup', function() {
      var title = Math.floor(Math.random() * 10223);
      $('#slug').val('event-name-' + title);
    });
  </script>

  <script>
    $(function() {
      $('input[name="datetime"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        timePicker24Hour: true,
        locale: {
          format: 'YYYY/MM/DD HH:mm'
        }
      });
    });
  </script>
@endsection
