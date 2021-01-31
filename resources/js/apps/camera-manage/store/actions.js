import api from '../api/fixtures'

export const ACTION1 = ({ commit }) => {
    commit('')
}

export const ACTION2 = async ({ commit, state, dispatch }, payload) => {
    commit('', null)
    let data = await api.call(payload.a, payload.b, payload.c)
    if (data.success) {
        dispatch('');
    } else {
        commit('', data.error_message)
    }
}

export const getCameras = async ({ commit, state, dispatch }) => {  
    let response = await api.getCameras({pageNum: state.global.pageNum, search: state.global.search})
    commit('SET_CAMERAS', response.cameras)
    commit('SET_PAGINATION', {
        totalCount:response.total, pageNum:response.current_page, pageSize:response.per_page
    })
}

export const addCamera = async ({ commit, state, dispatch }, payload) => {  
    commit('SET_USER_SAVE_ERROR', '')
    let response = await api.addCamera(payload)
    if (response.success) {
        commit('SET_USER_SAVED', true)
        dispatch('getCameras')
    } else {
        commit('SET_USER_SAVE_ERROR', response.error)
    }
}

export const deleteCamera = async ({ commit, state, dispatch }, payload) => {  
    let response = await api.deleteCamera(payload)
    if (response.success) {
        commit('SET_USER_DELETED', true)
        dispatch('getCameras')
    }
}

export const editCamera = async ({ commit, state, dispatch }, payload) => {  
    commit('SET_USER_EDIT_ERROR', '')
    let response = await api.editCamera(payload)
    if (response.success) {
        commit('SET_USER_EDITED', true)
        dispatch('getCameras')
    } else {
        commit('SET_USER_EDIT_ERROR', response.error)
    }
}

export const clearAddCameraModal = ({commit, state, dispatch}) => {
    commit('SET_USER_SAVED', false)
    commit('SET_USER_SAVE_ERROR', '')
}

export const clearEditCameraModal = ({commit, state, dispatch}) => {
    commit('SET_USER_EDITED', false)
    commit('SET_USER_EDIT_ERROR', '')
}

export const clearDeleteCameraModal = ({commit, state, dispatch}) => {
    commit('SET_USER_DELETED', false)
}

export const setSearch = ({ commit, state, dispatch }, payload) => {
    commit('SET_SEARCH', payload)
}

export const setPageNum = ({ commit, state, dispatch }, payload) => {
    commit('SET_PAGE_NUM', payload)
}

export const setDeleteCameraId = ({ commit, state, dispatch }, payload) => {
    commit('SET_DELETE_USER_ID', payload)
}

export const setEditCameraId = ({ commit, state, dispatch }, payload) => {
    commit('SET_EDIT_USER_ID', payload)
}

export const setViewCameraId = ({ commit, state, dispatch }, payload) => {
    commit('SET_VIEW_USER_ID', payload)
}