@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

{{--@if ($errorList = Session::get('error_csv_load'))

    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
    @foreach($errorList as $error)
            <li> {{ $error['message'][0] }} en la linea <strong>{{ $error['row'] }}</strong> del csv</li>
    @endforeach
        </ul>
    </div>
@endif--}}

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errorList = Session::get('error_csv_load'))

    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
            @foreach($errorList as $error)
                <li> {{ $error['message'][0] }} en la linea <strong>{{ $error['row'] }}</strong> del csv</li>
            @endforeach
        </ul>
    </div>
@endif

