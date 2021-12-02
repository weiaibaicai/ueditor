<div class="{{$viewClass['form-group']}} {!! !$errors->has($column) ?: 'has-error' !!}">
    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>
    <div class="{{$viewClass['field']}}">
        @include('admin::form.error')

        <script name="{{$name}}" type="text/plain" {!! $attributes !!} ></script>
        @include('admin::form.help-block')

    </div>
    <input type="hidden" id="{{$id}}-vla" value="{{$value}}">
    <script>
        UEDITOR_HOME_URL='{{ $homeUrl }}';
    </script>

</div>
