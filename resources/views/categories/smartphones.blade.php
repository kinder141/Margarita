@extends('pages.catalog')

@section('filters')
    <form action="{{ route('smartphones') }}" method="get">
        <div class="row">
            <label class="label" for="from">
                From
            </label>
            <input type="number" min="1" step="any" id="from" name="from" value="{{ (isset($data['from'])) ? $data['from'] : '' }}"/>
        </div>
        <div class="row">
            <label class="label" for="to">
                To
            </label>
            <input type="number" min="1" step="any" id="to" name="to" value="{{ (isset($data['to'])) ? $data['to'] : '' }}"/>
        </div>
        <div class="row">
            <input type="checkbox" name="checkbox16" id="checkbox1" {{ (isset($data['checkbox16'])) ? 'checked' : '' }}/>
            <label for="checkbox1">
                16 Gb
            </label>
        </div>
        <div class="row">
            <input type="checkbox" name="checkbox32" id="checkbox2" {{ (isset($data['checkbox32'])) ? 'checked' : '' }}/>
            <label for="checkbox1">
                32 Gb
            </label>
        </div>
        <div class="row">
            <input type="checkbox" name="checkbox64" id="checkbox3" {{ (isset($data['checkbox64'])) ? 'checked' : '' }}/>
            <label for="checkbox1">
                64 Gb
            </label>
        </div>
        <div class="row">
            <input type="checkbox" name="checkbox128" id="checkbox4" {{ (isset($data['checkbox128'])) ? 'checked' : '' }}/>
            <label for="checkbox1">
                128 Gb
            </label>
        </div>
        <div class="row">
            <input type="checkbox" name="checkbox256" id="checkbox5" {{ (isset($data['checkbox256'])) ? 'checked' : '' }}/>
            <label for="checkbox1">
                256 Gb
            </label>
        </div>
        <div class="row">
            <label class="label" for="input1">
                Name
            </label>
            <input type="text" id="input1" name="name" value="{{ (isset($data['name'])) ? $data['name'] : '' }}"/>
        </div>
        <div class="row">
            <button>Apply</button>
        </div>
    </form>
@endsection