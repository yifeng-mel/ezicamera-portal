const state = {
    cameras: [],
    pageNum: 1,
    pageSize: 10,
    totalCount: 0,
    currentPageCount: 0,
    search: ''
}

const mutations = {
    SET_CAMERAS(state, value) {
        state.cameras = value;
        state.currentPageCount = state.cameras.length
    },
    SET_SEARCH(state, value) {
        state.search = value;
    },
    SET_PAGINATION(state, payload) {
        state.pageNum       = payload.pageNum
        state.pageSize      = payload.pageSize
        state.totalCount    = payload.totalCount
    },
    SET_PAGE_NUM(state, payload) {
        state.pageNum = payload
    }
}

export default {
    state,
    mutations
}