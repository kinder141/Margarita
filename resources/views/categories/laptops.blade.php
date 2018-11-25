@extends('pages.catalog')

@section('filters')
    <form id="filter-form" action="{{ route('laptops') }}" method="get">
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
            <input type="checkbox" name="checkbox2" value="2048" id="checkbox1" {{ (isset($data['checkbox2'])) ? 'checked' : '' }}/>
            <label for="checkbox1">
                2 GB
            </label>
        </div>
        <div class="row">
            <input type="checkbox" name="checkbox4" value="4096" id="checkbox2" {{ (isset($data['checkbox4'])) ? 'checked' : '' }}/>
            <label for="checkbox1">
                4 Gb
            </label>
        </div>
        <div class="row">
            <input type="checkbox" name="checkbox8" value="8192" id="checkbox3" {{ (isset($data['checkbox8'])) ? 'checked' : '' }}/>
            <label for="checkbox1">
                8 Gb
            </label>
        </div>
        <div class="row">
            <input type="checkbox" name="checkbox16" value="16384" id="checkbox4" {{ (isset($data['checkbox16'])) ? 'checked' : '' }}/>
            <label for="checkbox1">
                16 Gb
            </label>
        </div>
        <div class="row">
            <input type="radio" id="radio1" name="video" value="1" {{ (isset($data['video']) && $data['video'] == 1) ? 'checked' : '' }}/>
            <label for="radio1">
                Discrete
            </label>
        </div>
        <div class="row">
            <input type="radio" id="radio2" name="video" value="0" {{ (isset($data['video']) && $data['video'] == 0) ? 'checked' : '' }}/>
            <label for="radio2">
                Integrated
            </label>
        </div>
        <div class="row">
            <button>Apply</button>
        </div>
    </form>
@endsection