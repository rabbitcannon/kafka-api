<template>
    <form>
        <div class="container --section">
            <div class="__header">
                <h2>Profile</h2>
            </div>

            <div class="__content">
                <div class="row">
                    <div class="col">
                        <h6>
                            {{ user.first_name }} {{ user.last_name }}
                        </h6>
                        <hr />
                    </div>
                </div>

                <div class="row" style="margin-bottom: 12px;">
                    <div class="col-2 border-right">
                        Email
                    </div>
                    <div class="col-4">
                        <div v-if="editing">
                            <input type="text" class="form-control" v-bind:value="user.email" id="email">
                        </div>
                        <div v-else>
                            {{ user.email }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-2 border-right">
                        Phone/SMS
                    </div>
                    <div class="col-4">
                        <div v-if="editing">
                            <input type="text" class="form-control" v-bind:value="user.profile.phone" id="phone">
                        </div>
                        <div v-else>
                            {{ user.profile.phone }}
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col text-right">
                            <div v-if="editing">
                                <button class="btn btn-dark" v-on:click.submit.prevent="saveState()">
                                    <font-awesome-icon :icon="saveIcon"/> Save
                                </button>
                                <button class="btn btn-danger" v-on:click.prevent="editState()">
                                    <font-awesome-icon :icon="cancelIcon"/> Cancel
                                </button>
                            </div>
                            <div v-else>
                                <button class="btn btn-dark" v-on:click.prevent="editState()">
                                    <font-awesome-icon :icon="editIcon"/> Edit
                                </button>
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
    </form>
</template>


<script>
    import Axios from 'axios';
    import Toastr from 'toastr';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import { faCheck, faExclamationTriangle, faPencilAlt,faTimes,
        faBan, faSave } from '@fortawesome/fontawesome-free-solid';

    const user_id = $('#user').val();

    Toastr.options.closeMethod = 'fadeOut';
    Toastr.options.showMethod = 'fadeIn';
    Toastr.options.closeDuration = 300;
    Toastr.options.newestOnTop = false;
    Toastr.options.closeButton = true;

    export default {
        components: {
            FontAwesomeIcon
        },

        data() {
            return {
                user: {
                    profile: {}
                },
                loading: false,
                editing: false,
                noResults: false,
            }
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
            getUser() {
                this.loading = true;

                Axios.get('/api/user/' + user_id).then((response) => {
                    this.user = response.data;
                    this.loading = false;
                    if(!response.data.length) {
                        this.noResults = true;
                    }
                }).catch((error) => {
                    console.log(error);
                });
            },

            editState() {
                let toggle = this.editing === false ? this.editing = true : this.editing = false;
            },

            saveState() {
                Axios.put('/user/' + user_id + '/edit', {
                    email: $('#email').val(),
                    phone: $('#phone').val()
                }).then((response) => {
                    Toastr.success("<font-awesome-icon :icon='checkIcon' /> Profile saved.");
                    this.getUser();
                    this.editing = false;
                }).catch((error) => {
                    Toastr.error("<font-awesome-icon :icon='warningIcon' />" + error + ".");
                });
            }
        },

        created() {
            this.getUser();
        }
    }

</script>