const state = {
    cameraId: null,
    cameraDeleted: false
}

const mutations = {
    SET_DELETE_USER_ID(state, value) {
        state.cameraId = value
    },
    SET_USER_DELETED(state, value) {
        state.cameraDeleted = value
    }
}

export default {
    state,
    mutations
}