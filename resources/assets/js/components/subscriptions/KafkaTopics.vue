<template>
    <form v-on:submit.prevent="modifyTopics">
        <div class="container --section">
            <div class="__header">
                <h4>Kafka Topic Subscriptions</h4>
            </div>

            <div class="__content">

                <div class="row">
                    <div class="col-md-3">
                        <h6>Choose Kafka Topics:</h6>

                        <div class="input-container">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Development</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Management</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Operations</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">QA</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Incoming</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <h6>Subscribed Topics</h6>

                        <div class="input-container">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label" for="exampleCheck1">Dev Ops</label>
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

                    <div class="container --section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary btn-sm" id="topics-btn">Add</button>
                                    <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import Axios from 'axios';
    import TableHeader from './partials/Header.vue';

    export default {
        components: {
            TableHeader,
        },

        data() {
            return {
                services: [],
                loading: true
            }
        },

        methods: {
            modifyTopics() {
                $('#topics-btn').html('<img src="images/loader_x14w.svg"/> Saving...');

                setTimeout(function() {
                    alert('test topics');
                }, 1500);
            }
        },

        created() {
            // this.loading = true;
            // Axios.get(`/api/services/all`).then(response => {
            //     this.services = response.data.data;
            //     this.loading = false;
            // }).catch(e => {
            //     this.errors.push(e)
            // });
        },

        mounted() {
            this.loading = false;
        }
    }
</script>