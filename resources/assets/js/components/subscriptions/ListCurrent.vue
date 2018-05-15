<!--<template v-if="editing">-->
    <!--Editing-->
<!--</template>-->

<template>

    <div class="container --section">
        <div class="__header">
            <div>
                <h2>Subscriber Dashboard</h2>
            </div>
        </div>

        <div class="__content">
            <div class="row border-bottom">
                <div class="col-md-12">
                    <h6>Subscriptions:</h6>
                </div>
            </div>

            <div v-if="noResults" class="row">
                <div class="col-md-12 text-center">
                    <div style="padding: 20px 0;">
                        You currently have no subscriptions.
                    </div>
                </div>
            </div>

            <div v-else class="row" v-for="sub of subs" style="padding: 12px 0;">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border-bottom">
                                <h5>{{ sub.service_id }}</h5>
                                <small class="text-muted">Created on: {{ parsedCreationDate(sub.created_at) }}</small>
                            </div>

                            <div class="text-center" style="padding: 10px 0;">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">Debug</div>
                                            <div class="col">Warning</div>
                                            <div class="col">Critical+</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">Email</div>
                                            <div class="col">Push</div>
                                            <div class="col">SMS</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">Hourly</div>
                                            <div class="col">Daily</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span v-if="sub.debug === 1">
                                                    <font-awesome-icon class="text-success" :icon="checkIcon"/>
                                                </span>
                                                <span v-else>
                                                    <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <span v-if="sub.warning === 1">
                                                    <font-awesome-icon class="text-success" :icon="checkIcon"/>
                                                </span>
                                                <span v-else>
                                                    <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <span v-if="sub.critical === 1">
                                                    <font-awesome-icon class="text-success" :icon="checkIcon"/>
                                                </span>
                                                <span v-else>
                                                    <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span v-if="sub.email === 1">
                                                    <font-awesome-icon class="text-success" :icon="checkIcon"/>
                                                </span>
                                                <span v-else>
                                                    <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <span v-if="sub.push === 1">
                                                    <font-awesome-icon class="text-success" :icon="checkIcon"/>
                                                </span>
                                                <span v-else>
                                                    <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <span v-if="sub.sms === 1">
                                                    <font-awesome-icon class="text-success" :icon="checkIcon"/>
                                                </span>
                                                <span v-else>
                                                    <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span v-if="sub.hourly === 1">
                                                    <font-awesome-icon class="text-success" :icon="checkIcon"/>
                                                </span>
                                                <span v-else>
                                                    <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <span v-if="sub.daily === 1">
                                                    <font-awesome-icon class="text-success" :icon="checkIcon"/>
                                                </span>
                                                <span v-else>
                                                    <font-awesome-icon class="text-danger" :icon="timesIcon"/>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top" style="padding-top: 12px;">
                                <a v-bind:href="'/edit/' + sub.id" class="btn btn-dark" v-on:click.prevent="editState(sub.id)">
                                    <font-awesome-icon :icon="editIcon"/> Edit
                                </a>
                                <a v-bind:href="'/delete/' + sub.id" class="btn btn-danger" v-on:click.prevent="deleteState(sub.id)">
                                    <font-awesome-icon :icon="deleteIcon"/> Delete
                                </a>
                            </div>
                        </div>
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
    import Toastr from 'toastr';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import { faCheck, faExclamationTriangle, faPencilAlt,
        faTrashAlt, faTimes } from '@fortawesome/fontawesome-free-solid';
    import Moment from 'moment';

    import TableHeader from '../services/partials/Header.vue';

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
            },
            editIcon() {
                return faPencilAlt
            },
            deleteIcon() {
                return faTrashAlt
            },
            timesIcon() {
                return faTimes
            }
        },

        components: {
            TableHeader,
            FontAwesomeIcon
        },

        data() {
            return {
                subs: [],
                loading: false,
                noResults: false,
                editing: false,
            }
        },

        methods: {
            editState: function(id) {
                if(this.editing === false) {
                    this.editing = true;
                }
                else {
                    this.editing = true;
                }
            },
            deleteState: function(id) {
                axios.post('/subscription/delete/' + id).then(() => {
                    toastr.success("<font-awesome-icon :icon='checkIcon' /> Subscription has been deleted.");
                }).catch((error) => {
                    toastr.error("<font-awesome-icon :icon='checkIcon' /> Error, please try again.")
                });
            },
            getSubscriptions() {
                this.loading = true;
                Axios.get('/subscriptions/list').then((response) => {
                    this.subs = response.data;
                    this.loading = false;
                    if(!response.data.length) {
                        this.noResults = true;
                    }
                }).catch((error) => {
                    console.log(error);
                });
            },
            parsedCreationDate(date) {
                return Moment(date).format('MM/DD/YYYY');
            },
        },

        created() {
            this.getSubscriptions();
            this.toggleEditingState();
        }
    }
</script>