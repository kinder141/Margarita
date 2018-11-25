@extends('pages.catalog')

@section('filters')
    <form action="{{ route('televisions') }}" method="get">
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
            <label for="select1">Manufacturer</label>
            <select name="manufacture" id="select1">
                <option value="SONY" {{ (isset($data['manufacture']) && $data['manufacture'] == 'SONY') ? 'selected' : '' }}>SONY</option>
                <option value="LG" {{ (isset($data['manufacture']) && $data['manufacture'] == 'LG') ? 'selected' : '' }}>LG</option>
                <option value="SAMSUNG" {{ (isset($data['manufacture']) && $data['manufacture'] == 'SAMSUNG') ? 'selected' : '' }}>SAMSUNG</option>
                <option value="SHARP" {{ (isset($data['manufacture']) && $data['manufacture'] == 'SHARP') ? 'selected' : '' }}>SHARP</option>
            </select>
        </div>
        <div class="row">
            <label for="select2">Display</label>
            <select multiple name="displays[]" id="select2">
                <option value="42.0" {{ (isset($data['displays']) && in_array(42.0, $data['displays'])) ? 'selected' : '' }}>42.0</option>
                <option value="45.2" {{ (isset($data['displays']) && in_array(45.2, $data['displays'])) ? 'selected' : '' }}>45.2</option>
                <option value="55.4" {{ (isset($data['displays']) && in_array(55.4, $data['displays'])) ? 'selected' : '' }}>55.4</option>
                <option value="65.5" {{ (isset($data['displays']) && in_array(65.5, $data['displays'])) ? 'selected' : '' }}>65.5</option>
                <option value="75.5" {{ (isset($data['displays']) && in_array(75.5, $data['displays'])) ? 'selected' : '' }}>75.5</option>
            </select>
        </div>
        <div class="row">
            <button>Apply</button>
        </div>
    </form>
@endsection