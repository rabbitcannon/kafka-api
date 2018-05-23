<template>
    <div>
        <b-modal v-model="modalShowValue" title="Are you sure?">
            Do you wish to confirm deletion of subscription ID: {{ sub_id }}
            <div slot="modal-footer" class="w-100">
                <b-container fluid>
                    <b-row>
                        <b-col cols="3"></b-col>
                        <b-col cols="6">
                            <b-btn size="md" class="btn btn-dark" v-on:click.prevent="deleteState(sub_id)">
                                <font-awesome-icon :icon="deleteIcon"/> Delete
                            </b-btn>
                            <b-btn size="md" class="btn btn-danger" v-on:click.prevent="modalShowValue = !modalShowValue">
                                <font-awesome-icon :icon="cancelIcon"/> Cancel
                            </b-btn>
                        </b-col>
                        <b-col colse="3"></b-col>
                    </b-row>
                </b-container>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import { faCheck, faExclamationTriangle, faPencilAlt,
        faTrashAlt, faTimes, faBan } from '@fortawesome/fontawesome-free-solid';
    import { button, modal, layout } from 'bootstrap-vue/es/components';

    export default {
        props: [
            'sub_id', 'modalShow'
        ],

        components: {
            FontAwesomeIcon,
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
        },

        data () {
            return {
                modalShowValue: this.modalShow
            }
        },
    }
</script>