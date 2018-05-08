<template>
    <form id="add-sub-form" v-on:submit.prevent="addSubscription" action="/subscriptions/create" method="post">
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
                <table-header></table-header>

                <div class="row" v-for="service of services" style="padding: 5px 0;" name="service_row" v-bind:id="'service-row-' + service.id">
                    <div class="col-md-3">
                        <div class="form-check">
                            <input type="checkbox" v-validate="'required'" class="form-check-input" name="service[]" v-bind:id="'service_' + service.id">
                            <label class="form-check-label" :for="'service_' + service.id">
                                {{ service.name }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-container">
                            <div class="form-check d-inline" v-for="alert_type of alert_types">
                                <input type="checkbox" class="form-check-input" name="type[]" v-bind:id="alert_type.name.toLowerCase() + '_' + service.id">
                                <label class="form-check-label" :for="alert_type.name.toLowerCase() + '_' + service.id">
                                    {{ alert_type.name }}&nbsp;
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-container">
                            <div class="form-check d-inline" v-for="alert_method of alert_methods">
                                <input type="checkbox" class="form-check-input" name="method[]" v-bind:id="alert_method.name.toLowerCase() + '_' + service.id">
                                <label class="form-check-label" :for="alert_method.name.toLowerCase() + '_' + service.id">
                                    {{ alert_method.name }}&nbsp;
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-container">
                            <div class="form-check d-inline" v-for="alert_frequency of alert_frequencies">
                                <input type="checkbox" class="form-check-input" name="frequency[]"
                                       v-bind:id="alert_frequency.name.toLowerCase().replace(/\s/g,'') + '_' + service.id">
                                <label class="form-check-label" :for="alert_frequency.name.toLowerCase().replace(/\s/g,'_') + '_' + service.id">
                                    {{ alert_frequency.name }}&nbsp;
                                </label>
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
        </div>

        <div class="container --section">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary btn-sm" id="subscribe-btn">Subscribe</button>
                        <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import Axios from 'axios';
    import Toastr from 'toastr';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import { faCheck, faExclamationTriangle } from '@fortawesome/fontawesome-free-solid';
    import TableHeader from './partials/Header.vue';

    Toastr.options.closeMethod = 'fadeOut';
    Toastr.options.showMethod = 'fadeIn';
    Toastr.options.closeDuration = 300;
    Toastr.options.newestOnTop = false;
    Toastr.options.closeButton = true;

	export default {
        computed: {
            checkIcon() {
                return faCheck
            },
            warningIcon() {
                return faExclamationTriangle
            }
        },

        components: {
            TableHeader,
            FontAwesomeIcon
        },

        data() {
            return {
                services: [],
                alert_types: [],
                alert_methods: [],
                alert_frequencies: [],
                loading: false,
            }
        },

        methods: {
            addSubscription() {
                $('button#subscribe-btn').html('<img src="images/loader_x14w.svg"/> Saving...');
                let serviceDivs = $("div[name='service_row']");
				let subscriptionArray = [];

                serviceDivs.each(function() {
                    let $row = $(this).attr('id');
                    let subscription = [];

                    $('#' + $row).each(function() {
                        $(this).find('input[type=checkbox]:checked').map(function() {
                            $(this).each(function() {
                                subscription.push($(this).attr('id'));
                            });
                        });
					});
                    if(subscription.length > 0) {
                        subscriptionArray.push(subscription);
                    }
                });
                console.log(subscriptionArray);
                if(subscriptionArray === undefined || subscriptionArray.length === 0) {
					$('#subscribe-btn').html('Subscribe');

					setTimeout(function() {
                        Toastr.error("<font-awesome-icon :icon='faExclamationTriangle' /> You need to set subscription items.");
                    }, 500)
                }
                else {
					Axios.post('/subscriptions/create', {
						data: subscriptionArray
					}).then(() => {
					    Toastr.success("<font-awesome-icon :icon='checkIcon' /> Subscription saved.");
						$('form#add-sub-form').trigger('reset');
					}).catch((error) => {
						console.log(error);
					});
                }
			},
            getServices() {
                return Axios.get('/api/services/all');
            },
            getAlertTypes() {
                return Axios.get('/api/alerts/types');
            },
            getAlertMethods() {
                return Axios.get('/api/alerts/methods');
            },
            getAlertFrequency() {
                return Axios.get('/api/alerts/frequency');
            }
        },

        created() {
			this.loading = true;
            Axios.all([
                this.getServices(), this.getAlertTypes(), this.getAlertMethods(), this.getAlertFrequency()
            ]).then(Axios.spread((servicesResults, alertTypeResults, alertMethodsResults, alertFrequencyResults) => {
                this.services = servicesResults.data.data;
                this.alert_types = alertTypeResults.data.data;
                this.alert_methods = alertMethodsResults.data.data;
                this.alert_frequencies = alertFrequencyResults.data.data;
                this.loading = false;
            }));
        },
    }
</script>
