const state = {
    cameraId: null,
    error: '',
    cameraEdited: false
}

const mutations = {
    SET_EDIT_USER_ID(state, value) {
        state.cameraId = value
    },
    SET_USER_EDIT_ERROR(state, value) {
        state.error = value
    },
    SET_USER_EDITED(state, value) {
        state.cameraEdited = value
    }
}

export default {
    state,
    mutations
}