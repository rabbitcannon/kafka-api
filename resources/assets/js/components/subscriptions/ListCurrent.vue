<template>
    <div>

        <div class="container --section">
            <div class="__header">
                <div>
                    <h2>Subscriber Dashboard</h2>
                </div>
                <div>
                    <h4>Current</h4>
                </div>
            </div>
            <div class="__content" style="padding: 0;">
                <table class="table table-borderless sub-list" style="margin-bottom: 0;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <div style="float: left;">
                                    Current Subscriptions
                                </div>
                                <div style="float: right;">
                                    <a id="toggle-subs" v-on:click="togglePanel()">
                                        <div v-if="panelState">
                                            <font-awesome-icon :icon='arrowDoubleDown' />
                                        </div>
                                        <div v-else>
                                            <small class="small-label">( results hidden )</small>
                                            &nbsp;<font-awesome-icon :icon='arrowDoubleUp' />
                                        </div>
                                    </a>
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="sub of subs">
                            <result-item v-bind:id="sub.id" v-bind:service_id="sub.service_id" v-bind:debug="sub.debug"
                                         v-bind:warning="sub.warning" v-bind:critical="sub.critical" v-bind:email="sub.email"
                                         v-bind:push="sub.push" v-bind:sms="sub.sms" v-bind:alerts="sub.alerts"
                                         v-bind:hourly="sub.hourly" v-bind:daily="sub.daily"></result-item>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import { faAngleDoubleDown, faAngleDoubleUp } from '@fortawesome/fontawesome-free-solid';

    import resultItem from './components/result-item.vue';

    export default {
        computed: {
            arrowDoubleUp() {
                return faAngleDoubleUp
            },
            arrowDoubleDown() {
                return faAngleDoubleDown
            },
        },

        components: {
            FontAwesomeIcon,
            resultItem,
        },

        data() {
            return {
                subs: [],
                loading: false,
                noResults: false,
                panelState: true,
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
            togglePanel() {
                $('table.sub-list tbody').slideToggle(250, function() {
                    $('.small-label').fadeToggle(250);
                });
                let panelToggle = this.panelState === true ? this.panelState = false : this.panelState = true;
            }
        },

        created() {
            this.getSubscriptions();
        }
    }
</script>