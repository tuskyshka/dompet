@extends('layouts.app')

@section('title', __('loan.edit'))

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        @if (request('action') == 'delete' && $loan)
        @can('delete', $loan)
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ __('loan.delete') }}</h3></div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <tbody>
                            <tr><td>{{ __('loan.partner') }}</td><td>{{ $loan->partner->name }}</td></tr>
                            <tr><td>{{ __('loan.type') }}</td><td>{{ $loan->type }}</td></tr>
                            <tr><td>{{ __('loan.amount') }}</td><td class="text-right">{{ $loan->amount_string }}</td></tr>
                            <tr><td>{{ __('loan.planned_payment_count') }}</td><td class="text-right">{{ $loan->planned_payment_count }}</td></tr>
                            <tr><td>{{ __('loan.payment_total') }}</td><td class="text-right">{{ $loan->payment_total_string }}</td></tr>
                            <tr><td>{{ __('loan.payment_remaining') }}</td><td class="text-right">{{ $loan->payment_remaining_string }}</td></tr>
                            <tr><td>{{ __('loan.description') }}</td><td>{{ $loan->description }}</td></tr>
                            <tr><td>{{ __('loan.start_date') }}</td><td>{{ $loan->start_date }}</td></tr>
                            <tr><td>{{ __('loan.end_date') }}</td><td>{{ $loan->end_date }}</td></tr>
                        </tbody>
                    </table>
                </div>
                <hr style="margin:0">
                <div class="panel-body text-danger">{{ __('loan.delete_confirm') }}</div>
                <div class="panel-footer">
                    {!! FormField::delete(
                        ['route' => ['loans.destroy', $loan]],
                        __('app.delete_confirm_button'),
                        ['class' => 'btn btn-danger'],
                        ['loan_id' => $loan->id]
                    ) !!}
                    {{ link_to_route('loans.edit', __('app.cancel'), [$loan], ['class' => 'btn btn-default']) }}
                </div>
            </div>
        @endcan
        @else
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">{{ __('loan.edit') }}</h3></div>
            {{ Form::model($loan, ['route' => ['loans.update', $loan], 'method' => 'patch']) }}
            <div class="panel-body">
                {!! FormField::select('partner_id', $partners, ['required' => true, 'label' => __('loan.partner')]) !!}
                {!! FormField::radios('type_id', $loanTypes, ['required' => true, 'label' => __('loan.type')]) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! FormField::text('amount', ['required' => true, 'type' => 'number', 'label' => __('loan.amount')]) !!}
                    </div>
                    <div class="col-md-6">
                        {!! FormField::text('planned_payment_count', ['required' => true, 'type' => 'number', 'value' => old('planned_payment_count', $loan->planned_payment_count), 'label' => __('loan.planned_payment_count')]) !!}
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
                {{ Form::submit(__('loan.update'), ['class' => 'btn btn-success']) }}
                {{ link_to_route('loans.show', __('app.cancel'), [$loan], ['class' => 'btn btn-default']) }}
                @can('delete', $loan)
                    {{ link_to_route('loans.edit', __('app.delete'), [$loan, 'action' => 'delete'], ['class' => 'btn btn-danger pull-right', 'id' => 'del-loan-'.$loan->id]) }}
                @endcan
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endif
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
