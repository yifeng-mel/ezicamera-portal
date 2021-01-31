import Axios from "axios";
const urlParams = new URLSearchParams(window.location.search);

export default {
	getInit() {
		return new Promise(function(resolve, reject) {
            Axios.get("", {params: {
            }})
            .then(({ data }) => { resolve(data); })
            .catch(error => { reject(error); });
        });
    },
	getCameras(payload) {
		return new Promise(function(resolve, reject) {
            Axios.get("/api/cameras", {params: {
                'pageNum': payload.pageNum,
                'search': payload.search
            }})
            .then(({ data }) => { resolve(data); })
            .catch(error => { reject(error); });
        });
    },
    addCamera(payload) {
		return new Promise(function(resolve, reject) {
            Axios.post("/api/add-camera",  {
                'serial_number': payload.serial_number,
                'board_name': payload.board_name,
                'color': payload.color,
                'price': payload.price,
                'url': payload.url,
                'public_key': payload.public_key
            })
            .then(({ data }) => { resolve(data); })
            .catch(error => { reject(error); });
        });
    },
    deleteCamera(payload) {
		return new Promise(function(resolve, reject) {
            Axios.post("/api/delete-camera",  {
                'camera_id': payload
            })
            .then(({ data }) => { resolve(data); })
            .catch(error => { reject(error); });
        });
    },
    editCamera(payload) {
		return new Promise(function(resolve, reject) {
            Axios.post("/api/edit-camera",  {
                'camera_id': payload.camera_id,
                'serial_number': payload.serial_number,
                'board_name': payload.board_name,
                'color': payload.color,
                'price': payload.price,
                'url': payload.url,
                'public_key': payload.public_key
            })
            .then(({ data }) => { resolve(data); })
            .catch(error => { reject(error); });
        });
    },
};
