<template>
    <div class="container --section">
        <div class="__header">
            <div>
                <h2>Subscriber Dashboard</h2>
            </div>
        </div>

        <div class="__content">
            <div class="row border-bottom">
                <div class="col-md-3">
                    <h6>Subscriptions:</h6>
                </div>
            </div>

            <div v-if="noResults" class="col-md-12 text-center">
                <div style="padding: 20px 0;">
                    You currently have no subscriptions.
                </div>
            </div>

            <div v-else class="row" v-for="sub of subs">
                <div class="col-md-12">
                    <h5>{{ sub.service_id }}</h5> | Created on: {{ parsedCreationDate(sub.created_at) }}
                    <div>
                        <button class="btn btn-dark">
                            <font-awesome-icon :icon="editIcon"/> Edit
                        </button>
                        <button class="btn btn-danger">
                            <font-awesome-icon :icon="deleteIcon"/> Delete
                        </button>

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
        faTrashAlt } from '@fortawesome/fontawesome-free-solid';
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
            }
        },

        methods: {
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
        }
    }
</script>