<template>
	<div>
		<CamerasTable />
		<AddCameraModal />
		<DeleteCameraModal />
		<EditCameraModal />
		<ViewCameraModal />
	</div>
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";
import CamerasTable from "./CamerasTable";
import AddCameraModal from "./AddCameraModal";
import DeleteCameraModal from "./DeleteCameraModal";
import EditCameraModal from "./EditCameraModal";
import ViewCameraModal from "./ViewCameraModal";

export default {
	name: "App",
	components: {
		CamerasTable: CamerasTable,
		AddCameraModal: AddCameraModal,
		EditCameraModal: EditCameraModal,
		DeleteCameraModal: DeleteCameraModal,
		ViewCameraModal: ViewCameraModal,
	},
	async mounted() {
		await this.getCameras();
	},
	data() {
		return {
		};
	},
	computed: {
		...mapGetters({
		}),
		...mapState({
		})
	},
	methods: {
		...mapActions(["getCameras"])
	},
	watch: {
	}
};
</script>

<style lang="">
</style>
