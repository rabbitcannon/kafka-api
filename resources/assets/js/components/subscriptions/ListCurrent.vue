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

            <div v-else class="container" v-for="sub of subs">
                <result-item v-bind:id="sub.id" v-bind:service_id="sub.service_id" v-bind:debug="sub.debug"
                             v-bind:warning="sub.warning" v-bind:critical="sub.critical" v-bind:email="sub.email"
                             v-bind:push="sub.push" v-bind:sms="sub.sms" v-bind:alerts="sub.alerts"
                             v-bind:hourly="sub.hourly" v-bind:daily="sub.daily"></result-item>
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

    import resultItem from './components/result-item.vue';

    export default {
        components: {
            resultItem,
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
        },

        created() {
            this.getSubscriptions();
        }
    }
</script>