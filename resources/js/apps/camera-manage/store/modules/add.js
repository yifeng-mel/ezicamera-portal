const state = {
    error: '',
    cameraSaved: false
}

const mutations = {
    SET_USER_SAVE_ERROR(state, value) {
        state.error = value
    },
    SET_USER_SAVED(state, value) {
        state.cameraSaved = value
    }
}

export default {
    state,
    mutations
}