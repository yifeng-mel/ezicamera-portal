<template>
    <div class="modal" id="viewCameraModal" tabindex="-1" role="dialog" aria-labelledby="viewCameraModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCameraModalLabel">View Camera</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" v-if="getViewCamera">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            </div>

                            <h3 class="profile-Cameraname text-center">{{getViewCamera.serial_number}}</h3>

                            <p class="text-muted text-center">{{getViewCamera.color}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Board Name:</b> <a class="float-right">{{getViewCamera.board_name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Public Key:</b> <div>{{getViewCamera.public_key}}</div>
                                </li>
                            </ul>

                        </div>
                    <!-- /.card-body -->
                    </div>
                </div>

                <div class="modal-footer justify-content-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";

export default {
    name: 'ViewCameraModal',
    props: [''],
    data() {
        return {
        }
    },
    methods: {
    },
    computed: {
        ...mapGetters({
            getViewCamera: 'getViewCamera'
        })
    }
}
</script>
<style>    
</style>
