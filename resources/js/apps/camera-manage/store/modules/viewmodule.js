const state = {
    cameraId: null,
}

const mutations = {
    SET_VIEW_USER_ID(state, value) {
        state.cameraId = value
    }
}

export default {
    state,
    mutations
}