@extends('layouts.app')

@section('title', __('loan.create'))

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">{{ __('loan.create') }}</h3></div>
            {{ Form::open(['route' => 'loans.store']) }}
            <div class="panel-body">
                {!! FormField::select('partner_id', $partners, ['required' => true, 'label' => __('loan.partner')]) !!}
                {!! FormField::radios('type_id', $loanTypes, ['required' => true, 'label' => __('loan.type')]) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! FormField::text('amount', ['required' => true, 'type' => 'number', 'label' => __('loan.amount')]) !!}
                    </div>
                    <div class="col-md-6">
                        {!! FormField::text('planned_payment_count', ['required' => true, 'type' => 'number', 'value' => old('planned_payment_count', 1), 'label' => __('loan.planned_payment_count')]) !!}
                    </div>
                </div>
                {!! FormField::textarea('description', ['label' => __('loan.description')]) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! FormField::text('start_date', ['class' => 'date-select', 'label' => __('loan.start_date')]) !!}
                    </div>
                    <div class="col-md-6">
                        {!! FormField::text('end_date', ['class' => 'date-select', 'label' => __('loan.end_date')]) !!}
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                {{ Form::submit(__('loan.create'), ['class' => 'btn btn-success']) }}
                {{ link_to_route('loans.index', __('app.cancel'), [], ['class' => 'btn btn-default']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection

@section('styles')
    {{ Html::style(url('css/plugins/jquery.datetimepicker.css')) }}
@endsection

@push('scripts')
    {{ Html::script(url('js/plugins/jquery.datetimepicker.js')) }}
<script>
(function () {
    $('.date-select').datetimepicker({
        timepicker:false,
        format:'Y-m-d',
        closeOnDateSelect: true,
        scrollInput: false
    });
})();
</script>
@endpush
