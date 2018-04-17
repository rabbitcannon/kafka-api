@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Subscriber Dashboard</h2><br>
        <h4>EOS Service Alerts</h4>
        <div class="row">

            <div class="col-md-auto">
                <h6>Choose Service:</h6>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="all-services" value="all-services" v-model="checkedServices">
                    <label class="form-check-label" for="all-services">All Services</label>
                    <br>
                    <span>Checked Services: @{{ checkedServices }}</span>
                </div>


                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">All Services</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Wallet</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check Processor</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">PAM</label>
                </div>
            </div>

            <div class="col-md-auto">
                <h6>Choose Error Type:</h6>
                <div class="form-check d-inline">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Debug</label>
                </div>
                <div class="form-check d-inline">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Warning</label>
                </div>
                <div class="form-check d-inline">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Critical+</label>
                </div>
            </div>

            <div class="col-md-auto">
                <h6>Choose Notification Method:</h6>
                <div class="form-check d-inline">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Email</label>
                </div>
                <div class="form-check d-inline">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Push</label>
                </div>
                <div class="form-check d-inline">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">SMS</label>
                </div>
            </div>

            <div class="col-md-auto">
                <h6>Choose Frequency of Alerts:</h6>
                <div class="form-check d-inline">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">All Alerts</label>
                </div>
                <div class="form-check d-inline">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Hourly</label>
                </div>
                <div class="form-check d-inline">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Daily</label>
                </div>
            </div>

        </div>

        <br>

        <h4>Kafka Topic Subscriptions</h4>
        <div class="row">

            <div class="col-md-auto">
                <h6>Choose Kafka Topics:</h6>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Development</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Management</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Operations</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">QA</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Incoming</label>
                </div>
            </div>

            <div class="col-md-auto">
                <h6>Subscribed Topics</h6>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                    <label class="form-check-label" for="exampleCheck1">Dev Ops</label>
                </div>
            </div>

        </div>
        <div class="float-right">
            <button type="button" class="btn btn-primary btn-sm">Subscribe</button>
            <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
        </div>


    </div>
@endsection

