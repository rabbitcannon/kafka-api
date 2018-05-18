<template>
    <form v-bind:id="'sub-form-' + id">
        <div class="row text-center" style="padding: 12px 0;">
            <div class="container">
                <div class="row border-bottom text-left">
                    <div class="col">
                        <span class="title">{{ service_id }}</span> <span v-if="loading"><img src="images/loader_x25.svg"/></span>
                    </div>
                </div>
            </div>

            <div class="container" style="padding-top: 25px;">
                <div class="row list">
                    <div class="col list__item">Debug</div>
                    <div class="col list__item">Warning</div>
                    <div class="col list__item">Critical+</div>
                    <div class="col list__item">Email</div>
                    <div class="col list__item">Push</div>
                    <div class="col list__item">SMS</div>
                    <div class="col list__item">All Alerts</div>
                    <div class="col list__item">Hourly</div>
                    <div class="col list__item">Daily</div>
                </div>
            </div>

            <div class="container" style="padding-bottom: 25px;">
                <div class="row list">
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="debugValue === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" value="1" v-bind:id="'debug-' + id" :checked="debugValue === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="warningValue === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" value="1" v-bind:id="'warning-' + id" :checked="warningValue === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="criticalValue === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" value="1" v-bind:id="'critical-' + id" :checked="criticalValue === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="emailValue === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" value="1" v-bind:id="'email-' + id" :checked="emailValue === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="pushValue === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" value="1" v-bind:id="'push-' + id" :checked="pushValue === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="smsValue === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" value="1" v-bind:id="'sms-' + id" :checked="smsValue === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="alertsValue === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" value="1" v-bind:id="'alerts-' + id" :checked="alertsValue === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="hourlyValue === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <div class="form-check">
                                <input type="checkbox" value="1" v-bind:id="'hourly-' + id" :checked="hourlyValue === 1">
                            </div>
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="dailyValue === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" value="1" v-bind:id="'daily-' + id" :checked="dailyValue === 1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row border-top ">
                    <div class="col text-left">
                        <small class="lean">Updated on: {{ parsedCreationDate(updated_at) }}</small>
                    </div>
                    <div class="col text-right" style="padding-top: 12px;">
                        <div v-if="!editing">
                            <button class="btn btn-dark" v-on:click.prevent="editState()">
                                <font-awesome-icon :icon="editIcon"/> Edit
                            </button>
                            <button class="btn btn-danger" v-on:click.prevent="deleteState(id)">
                                <font-awesome-icon :icon="deleteIcon"/> Delete
                            </button>
                        </div>
                        <div v-else>
                            <button class="btn btn-dark" v-on:click.submit.prevent="saveState(id)">
                                <font-awesome-icon :icon="saveIcon"/> Save
                            </button>
                            <button class="btn btn-danger" v-on:click.prevent="editState()">
                                <font-awesome-icon :icon="cancelIcon"/> Cancel
                            </button>
                        </div>
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
    import { faCheck, faExclamationTriangle, faPencilAlt,
        faTrashAlt, faTimes, faBan, faSave } from '@fortawesome/fontawesome-free-solid';
    import Moment from 'moment';

    Toastr.options.closeMethod = 'fadeOut';
    Toastr.options.showMethod = 'fadeIn';
    Toastr.options.closeDuration = 300;
    Toastr.options.newestOnTop = false;
    Toastr.options.closeButton = true;

    export default {
        props: [
            'id', 'service_id', 'updated_at', 'debug', 'warning',
            'critical', 'email', 'push', 'sms', 'alerts', 'hourly', 'daily'
        ],

        data() {
            return {
                loading: false,
                editing: false,
                debugValue: this.debug,
                warningValue: this.warning,
                criticalValue: this.critical,
                emailValue: this.email,
                pushValue: this.push,
                smsValue: this.sms,
                alertsValue: this.alerts,
                hourlyValue: this.hourly,
                dailyValue: this.daily,
            }
        },

        components: {
            FontAwesomeIcon
        },

        computed: {
            checkIcon() {
                return faCheck
            },
            warningIcon() {
                return faExclamationTriangle
            },
            editIcon() {
                return faPencilAlt
            },
            deleteIcon() {
                return faTrashAlt
            },
            timesIcon() {
                return faTimes
            },
            cancelIcon() {
                return faBan
            },
            saveIcon() {
                return faSave
            }
        },

        methods: {
            editState() {
                if(this.editing === false) {
                    this.editing = true;
                }
                else {
                    this.editing = false;
                }
            },
            saveState(id) {
                var inputArray = {};

                $('#sub-form-' +id).find('input:checkbox:checked').each(function() {
                    let parsedId = $(this).attr('id').replace('-' + id, "");
                    inputArray[parsedId] = $(this).val();
                });

                Axios.put('/subscriptions/edit/' + id, {
                    data: inputArray
                }).then((response) => {
                    if(response.status === 200) {
                        Toastr.success("<font-awesome-icon :icon='checkIcon' /> Subscription saved.");
                        this.getModifiedSubscription(id);
                    }
                }).catch((error) => {
                    Toastr.error("<font-awesome-icon :icon='warningIcon' />" + error + ".");
                });
            },
            deleteState(id) {
                Axios.post('/subscription/delete/' + id).then((response) => {
                    Toastr.success("<font-awesome-icon :icon='checkIcon' /> Subscription has been deleted.");
                    console.log(response);
                }).catch((error) => {
                    Toastr.error("<font-awesome-icon :icon='warningIcon' />" + error + ".");
                });
            },
            getModifiedSubscription(id) {
                this.loading = true;
                Axios.get('/subscriptions/single/' + id).then((response) => {
                    this.debugValue = response.data.debug;
                    this.warningValue =  response.data.warning;
                    this.criticalValue =  response.data.critical;
                    this.emailValue =  response.data.email;
                    this.pushValue =  response.data.push;
                    this.smsValue =  response.data.sms;
                    this.alertsValue =  response.data.alerts;
                    this.hourlyValue =  response.data.hourly;
                    this.dailyValue =  response.data.daily;
                    this.loading = false;
                    this.editing = false;
                }).catch((error) => {
                    console.log(error);
                });
            },
            parsedCreationDate(date) {
                return Moment(date).format('MM/DD/YYYY');
            },
        },
    }
</script>