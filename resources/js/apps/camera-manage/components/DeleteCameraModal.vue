<template>
    <div class="modal" id="deleteCameraModal" tabindex="-1" role="dialog" aria-labelledby="deleteCameraModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCameraModalLabel">Delete Camera</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click = "closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-if="camera">
                        Are you sure you want to delete camera:<br>
                        {{camera.serial_number}}
                        <h5 class="d-inline"><span class="badge badge-primary">{{camera.color}}</span></h5>
                    </div>
                    <div v-else-if="cameraDeleted">
                        <span class="text-success" v-if="cameraDeleted">Successfully Deleted!</span>
                    </div>
                </div>

                <div class="modal-footer justify-content-right">
                    <button v-if="!cameraDeleted" type="button" class="btn btn-danger" @click="handleDeleteCamera()">YES</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeModal()">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";

export default {
    name: 'DeleteCameraModal',
    props: [''],
    data() {
        return {
        }
    },
    methods: {
		...mapActions(["deleteCamera", "clearDeleteCameraModal"]),
        handleDeleteCamera() {
            this.deleteCamera(this.cameraId)
        },
        closeModal() {
            this.clearDeleteCameraModal()
        }
    },
    computed: {
        ...mapState({
            cameraId: state => state.deletemodule.cameraId,
            cameraDeleted: state => state.deletemodule.cameraDeleted
        }),
        ...mapGetters({
            camera: 'deleteCamera'
        })
    }
}
</script>
<style>    
</style>
