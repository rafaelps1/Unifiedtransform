@extends('layouts.app')
@section('title', __('Account Sectors'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">

            <div class="row">
                <div class="col-md-6">
                    <br>
                    <div class="panel panel-default">
                        <div class="page-panel-title">@lang('Account Sectors')</div>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="form-horizontal" action="{{url('/accounts/create-sector')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">@lang('Sector Name')</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ (!empty($sector->name))?$sector->name:old('name') }}" placeholder="@lang('Sector Name')" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">@lang('Sector Type')</label>

                                <div class="col-md-6">
                                    <select  class="form-control" name="type">
                                        <option value="income">@lang('Income')</option>
                                        <option value="expense">@lang('Expense')</option>
                                    </select>

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-danger">@lang('Save')</button>
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <br>
                    <div style="width:100%;">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>@lang('All Created Sectors')</h3>
                    <table class="table table-striped table-data-div">
                        <thead>
                            <tr>
                                <th>@lang('Sector Name')</th>
                                <th>@lang('Type')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($sectors as $sector)
                            <tr>
                                <td>{{$sector->name}}</td>
                                <td>{{ __($sector->type) }}</td>
                                <td>
                                    <a href="{{url('accounts/edit-sector/'.$sector->id)}}" class="btn btn-danger btn-xs" role="button">@lang('Edit')</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
	<style>
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
    </style>
    <script>
        'use strict';

        var data = {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [
                {
                    pointRadius: 0,
                    label: @json( __('Income')),
                    lineTension: 0,
                    data: [
                        @foreach( ($incomesByMonth ?? []) as $s)
                        {{ $s }},
                        @endforeach
                    ],
                    borderWidth: 1,
                    backgroundColor: "rgb(75, 192, 192)"
                },
                {
                    pointRadius: 0,
                    label: @json( __('Expense')),
                    lineTension: 0,
                    data: [
                        @foreach( ($expensesByMonth ?? []) as $s)
                        {{ $s }},
                        @endforeach
                    ],
                    borderWidth: 1,
                    backgroundColor: "rgba(255, 0, 0, 0.5)"
                }
            ]
        };

        var options = {
            title: {
                display: true,
                text: @json( __('Income and Expense (In Dollar) in Time Scale'))
            },
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                ]
            }
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, {
                type: "bar",
                data: data,
                options: options
            });
        }
	</script>
@endsection
