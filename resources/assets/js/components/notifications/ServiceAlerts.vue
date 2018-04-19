<template>
    <div>
        <table-header></table-header>
        <div class="row" v-for="service of services" style="padding: 5px 0;">
            <div class="col-md-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" v-bind:id="'service_' + service.id">
                    <label class="form-check-label" :for="'service_' + service.id">{{service.name}}</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-container">
                    <div class="form-check d-inline">
                        <input type="checkbox" class="form-check-input" v-bind:id="'debug_' + service.id">
                        <label class="form-check-label" :for="'debug_' + service.id">Debug</label>
                    </div>
                    <div class="form-check d-inline">
                        <input type="checkbox" class="form-check-input" v-bind:id="'warning_' + service.id">
                        <label class="form-check-label" :for="'warning_' + service.id">Warning</label>
                    </div>
                    <div class="form-check d-inline">
                        <input type="checkbox" class="form-check-input" v-bind:id="'critical_' + service.id">
                        <label class="form-check-label" :for="'critical_' + service.id">Critical+</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-container">
                    <div class="form-check d-inline">
                        <input type="checkbox" class="form-check-input" v-bind:id="'email_' + service.id">
                        <label class="form-check-label" :for="'email_' + service.id">Email</label>
                    </div>
                    <div class="form-check d-inline">
                        <input type="checkbox" class="form-check-input" v-bind:id="'push_' + service.id">
                        <label class="form-check-label" :for="'push_' + service.id">Push</label>
                    </div>
                    <div class="form-check d-inline">
                        <input type="checkbox" class="form-check-input" v-bind:id="'sms_' + service.id">
                        <label class="form-check-label" :for="'sms_' + service.id">SMS</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <!--<Frequencies v-bind:service-id="service.id"></Frequencies>-->
                <div class="input-container">
                    <div class="form-check d-inline">
                        <input type="checkbox" class="form-check-input" v-bind:id="'all_' + service.id">
                        <label class="form-check-label" :for="'all_' + service.id">All Alerts</label>
                    </div>
                    <div class="form-check d-inline">
                        <input type="checkbox" class="form-check-input" v-bind:id="'hourly_' + service.id">
                        <label class="form-check-label" :for="'hourly_' + service.id">Hourly</label>
                    </div>
                    <div class="form-check d-inline">
                        <input type="checkbox" class="form-check-input" v-bind:id="'daily_' + service.id">
                        <label class="form-check-label" :for="'daily_alert_' + service.id">Daily</label>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="loading">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="images/loader_x64.svg"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';
    import TableHeader from './partials/Header.vue';
    // import Frequencies from './partials/Frequency.vue';

    export default {
        components: {
            TableHeader,
            // Frequencies,
        },

        data() {
            return {
                services: [],
                loading: false
            }
        },

        created() {
            this.loading = true;
            Axios.get(`/api/services/all`).then(response => {
                this.services = response.data.data;
                this.loading = false;
            }).catch(e => {
                this.errors.push(e)
            });
        },
    }
</script>
