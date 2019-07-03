<template>
    <div>
        <subscription-list ref="updateSubs" v-on:get-subs="getSubscriptions()"></subscription-list>

        <form id="add-sub-form" v-on:submit.prevent="addSubscription()" action="/subscriptions/create" method="post">
            <div class="container --section">
                <div class="__header">
                    <div>
                        <h4>EOS Service Alerts</h4>
                    </div>
                </div>

                <div class="__content" style="padding: 0;">
                    <table class="table table-hover" style="margin-bottom: 0;">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col">Service</th>
                                <th scope="col">Error Type</th>
                                <th scope="col">Notification Method</th>
                                <th scope="col">Alert Frequency</th>
                            </tr>
                        </thead>

                        <tbody v-if="loading">
                            <tr>
                                <td colspan="4">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <img src="images/loader_x64.svg"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                        <tbody v-else>
                            <tr v-for="service of services" style="padding: 5px 0;" name="service_row" v-bind:id="'service-row-' + service.id">
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" v-validate="'required'" class="form-check-input" name="service[]" v-bind:id="'service_' + service.id">
                                        <label class="form-check-label" :for="'service_' + service.id">
                                            {{ service.name }}
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div v-bind:id="'alert_type_container-' + service.id" class="input-container">
                                        <div class="form-check d-inline" v-for="alert_type of alert_types">
                                            <input type="checkbox" class="form-check-input" name="type[]" v-bind:id="alert_type.name.toLowerCase() + '_' + service.id">
                                            <label class="form-check-label" :for="alert_type.name.toLowerCase() + '_' + service.id">
                                                {{ alert_type.name }}&nbsp;
                                            </label>
                                        </div>
                                        <div v-bind:id="'error_type-' + service.id" class="hidden">
                                            <small>Please select at least one alert type.</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div v-bind:id="'alert_method_container-' + service.id" class="input-container">
                                        <div class="form-check d-inline" v-for="alert_method of alert_methods">
                                            <input type="checkbox" class="form-check-input" name="method[]" v-bind:id="alert_method.name.toLowerCase() + '_' + service.id">
                                            <label class="form-check-label" :for="alert_method.name.toLowerCase() + '_' + service.id">
                                                {{ alert_method.name }}&nbsp;
                                            </label>
                                        </div>
                                        <div v-bind:id="'error_method-' + service.id" class="hidden">
                                            <small>Please select at least one alert method.</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div v-bind:id="'alert_frequency_container-' + service.id" class="input-container">
                                        <div class="form-check d-inline" v-for="alert_frequency of alert_frequencies">
                                            <input type="checkbox" class="form-check-input" name="frequency[]"
                                                   v-bind:id="alert_frequency.name.toLowerCase().replace(/\s/g,'') + '_' + service.id">
                                            <label class="form-check-label" :for="alert_frequency.name.toLowerCase().replace(/\s/g,'_') + '_' + service.id">
                                                {{ alert_frequency.name }}&nbsp;
                                            </label>
                                        </div>
                                        <div v-bind:id="'error_frequency-' + service.id" class="hidden">
                                            <small>Please select at least one alert frequency.</small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container --section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary btn-sm" v-on:click="$emit('get-subs')" id="subscribe-btn">Subscribe</button>
                            <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Axios from 'axios';
    import Toastr from 'toastr';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import { faCheck, faExclamationTriangle } from '@fortawesome/fontawesome-free-solid';

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
                let subButton = $('button#subscribe-btn');
                let serviceDivs = $("tr[name='service_row']");
				let subscriptionArray = [];

                subButton.html('<img src="images/loader_x14w.svg"/> Saving...');

                serviceDivs.each(function() {
                    let $row = $(this).attr('id');
                    let currentId = $row.replace("service-row-", "");
                    let subscription = [];

                    $('#' + $row).each(function() {
                        $(this).find('input[type=checkbox]:checked').map(function() {
                            $(this).each(function() {
                                subscription.push($(this).attr('id'));
                            });
                        });
					});

                    if(subscription.length > 0) {
                        let concatTail = currentId + ' input:checked';
                        let typeChecked =  $('div#alert_type_container-' + concatTail).length > 0;
                        let methodChecked =  $('div#alert_method_container-' + concatTail).length > 0;
                        let frequencyChecked =  $('div#alert_frequency_container-' + concatTail).length > 0;

                        if(typeChecked) {
                            $('div#alert_type_container-' + currentId).removeClass("error");
                            $('div#error_type-' + currentId).addClass("hidden");
                        }
                        else {
                            $('div#alert_type_container-' + currentId).addClass("error");
                            $('div#error_type-' + currentId).removeClass("hidden");
                        }

                        if(methodChecked) {
                            $('div#alert_method_container-' + currentId).removeClass("error");
                            $('div#error_method-' + currentId).addClass("hidden");
                        }
                        else {
                            $('div#alert_method_container-' + currentId).addClass("error");
                            $('div#error_method-' + currentId).removeClass("hidden");
                        }

                        if(frequencyChecked) {
                            $('div#alert_frequency_container-' + currentId).removeClass("error");
                            $('div#error_frequency-' + currentId).addClass("hidden");
                        }
                        else {
                            $('div#alert_frequency_container-' + currentId).addClass("error");
                            $('div#error_frequency-' + currentId).removeClass("hidden");
                        }

                        if(typeChecked && methodChecked && frequencyChecked) {
                            subscriptionArray.push(subscription);
                        }
                    }
                });

                if(subscriptionArray === undefined || subscriptionArray.length === 0) {
					subButton.html('Subscribe');

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
                        subButton.html('Subscribe');
                        // location.reload();
					}).catch((error) => {
						console.log(error);
					});
                }
			},
            resetForm() {
                $('#add-sub-form')[0].reset();
            },
            getServices() {
                // return Axios.get('/api/services/all');
                return Axios.get('/services/all');
            },
            getAlertTypes() {
                return Axios.get('/api/alerts/types');
            },
            getAlertMethods() {
                return Axios.get('/api/alerts/methods');
            },
            getAlertFrequency() {
                return Axios.get('/api/alerts/frequency');
            },
            getFullList() {
                this.loading = true;

                Axios.all([
                    this.getServices(), this.getAlertTypes(), this.getAlertMethods(), this.getAlertFrequency()
                ]).then(Axios.spread((servicesResults, alertTypeResults, alertMethodsResults, alertFrequencyResults) => {
                    this.services = servicesResults.data;
                    this.alert_types = alertTypeResults.data.data;
                    this.alert_methods = alertMethodsResults.data.data;
                    this.alert_frequencies = alertFrequencyResults.data.data;
                    this.loading = false;
                }));
            },
        },

        created() {
            this.getFullList();
        },
    }
</script>
