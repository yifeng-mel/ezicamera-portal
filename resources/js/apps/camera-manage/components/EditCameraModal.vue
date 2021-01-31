<template>
    <div class="modal" id="editFormModal" tabindex="-1" role="dialog" aria-labelledby="editFormModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFormModalLabel">Info detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click = "closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" @submit.prevent="edit">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Serial Number *</label>
                                <input type="text" class="form-control" id="inputName" placeholder="Serial Number"  v-model="serialNumber" name='serial_number'>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputName">Board Name *</label>
                                <input type="text" class="form-control" id="inputName" placeholder="Board Name"  v-model="boardName" name='board_name'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4">Color *</label>
                            <input auto-complete=off type="text" class="form-control" id="inputEmail4" placeholder="Color" v-model="color" name='color'>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Price</label>
                            <input type="text" class="form-control" id="inputPassword" placeholder="Price"  v-model="price" name='price'>
                        </div>
                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" class="form-control" placeholder="URL"  v-model="url" name='url'>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Public Key</label>
                            <textarea class="form-control" id="inputAddress" placeholder="Public Key"  v-model="publicKey" name='public_key'></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="text-success" v-if="cameraEdited">Successfully Edited!</span>
                        <span class="text-danger" v-if="error!=''">{{error}}</span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeModal()">Close</button>
                        <button type="submit" class="btn btn-primary" >Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";

export default {
    name: 'EditCameraModal',
    props: [''],
    data() {
        return {
            cameraId: null,
            serialNumber:'',
            boardName:'',
            color:'',
            price:'',
            url:'',
            publicKey:''
        }
    },
    methods: {
		...mapActions(["editCamera", "clearEditCameraModal"]),
        edit() {
            this.editCamera({
                camera_id: this.cameraId,
                serial_number: this.serialNumber,
                board_name: this.boardName,
                color: this.color,
                price: this.price,
                url: this.url,
                public_key: this.publicKey
            })
        },
        closeModal() {
            // this.cameraId = null
            // this.email = ''
            // this.password =''
            // this.firstName =''
            // this.lastName =''
            // this.mobile =''
            // this.address =''
            this.clearEditCameraModal()
        }
    },
    computed: {
        ...mapState({
            error: state => state.editmodule.error,
            cameraEdited: state => state.editmodule.cameraEdited
        }),
        ...mapGetters({
            getEditCamera: 'getEditCamera'
        })
    },
    watch: {
		getEditCamera(newEditCamera) {
            if (newEditCamera) {
                this.cameraId = newEditCamera.id
                this.serialNumber = newEditCamera.serial_number
                this.boardName = newEditCamera.board_name
                this.color = newEditCamera.color
                this.price = newEditCamera.price
                this.url = newEditCamera.url
                this.publicKey = newEditCamera.public_key
            }
		}
	}
}
</script>
<style>    
</style>
