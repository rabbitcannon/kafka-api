<template>
    <form action="">
        <div class="row text-center" style="padding: 12px 0;">
            <div class="container">
                <div class="row border-bottom text-left">
                    <div class="col">
                        <span class="title">{{ service_id }}</span>
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
                            <span v-if="debug === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" v-bind:id="'debug-' + id" v-bind:checked="debug === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="warning === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" v-bind:id="'warning-' + id" v-bind:checked="warning === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="critical === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" v-bind:id="'critical-' + id" v-bind:checked="critical === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="email === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" v-bind:id="'email-' + id" v-bind:checked="email === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="push === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" v-bind:id="'push-' + id" v-bind:checked="push === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="sms === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" v-bind:id="'sms-' + id" v-bind:checked="sms === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="alerts === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" v-bind:id="'alerts-' + id" v-bind:checked="alerts === 1">
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="hourly === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-bind:id="'hourly-' + id" v-bind:checked="hourly === 1">
                            </div>
                        </div>
                    </div>
                    <div class="col list__item">
                        <div v-if="!editing">
                            <span v-if="daily === 1">
                                <font-awesome-icon class="text-success" :icon="checkIcon"/>
                            </span>
                            <span v-else>
                                <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                            </span>
                        </div>
                        <div v-else>
                            <input type="checkbox" v-bind:id="'daily-' + id" v-bind:checked="daily === 1">
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
                            <button class="btn btn-dark" v-on:click.prevent="saveState()">
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
                editing: false,
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
            saveState() {
                Toastr.error("<font-awesome-icon :icon='warningIcon' /> Test.")
            },
            deleteState(id) {
                Axios.post('/subscription/delete/' + id).then((response) => {
                    Toastr.success("<font-awesome-icon :icon='checkIcon' /> Subscription has been deleted.");
                    console.log(response)
                }).catch((error) => {
                    Toastr.error("<font-awesome-icon :icon='warningIcon' />" + error + ".");
                });
            },
            parsedCreationDate(date) {
                return Moment(date).format('MM/DD/YYYY');
            },
        },
    }
</script>