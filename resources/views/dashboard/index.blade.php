@extends('layouts.app')

@section('content')

    <div class="container --section">
        <div class="__header">
            <div>
                <h2>Subscriber Dashboard</h2>
            </div>
            <div>
                <h4>EOS Service Alerts</h4>
            </div>
        </div>

        <div class="__content">
            <service-results></service-results>
        </div>
    </div>

    <div class="container --section">
        <div class="__header">
            <div>
                <h4>Kafka Topic Subscriptions</h4>
            </div>
        </div>

        <div class="__content">
            <kafka-topics></kafka-topics>
        </div>
    </div>

    <div class="container --section">
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm">Subscribe</button>
                    <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

