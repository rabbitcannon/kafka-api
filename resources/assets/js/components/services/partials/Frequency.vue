<template>
    <div class="input-container">
        <div class="form-check d-inline"  v-for="frequency of frequencies">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">{{ frequency.name}}</label>
            <!--{{serviceId}}-->
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';

    export default {
        // props: ['service-id'],

        data() {
            return {
                frequencies: [],
                loading: false
            }
        },

        created() {
            this.loading = true;
            Axios.get(`/api/services/frequency`).then(response => {
                this.frequencies = response.data.data;
                this.loading = false;
            }).catch(e => {
                this.errors.push(e)
            });
        }
    }
</script>