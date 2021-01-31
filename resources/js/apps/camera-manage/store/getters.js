// export const GETTER1 = state => state.vehicles.vehicles.length

export const GETTER2 = (state) => (vehicleId) => {
}

export const nextPageNum = state => 
        state.global.pageNum * state.global.pageSize < state.global.totalCount ? 
        state.global.pageNum + 1 :
        state.global.pageNum

export const prevPageNumber = state => state.global.pageNum > 1 ?
    state.global.pageNum - 1 :
    1

export const currentPageFrom = state => (state.global.pageNum-1) * state.global.pageSize + 1

export const currentpageTo = state => (state.global.pageNum-1) * state.global.pageSize + state.global.currentPageCount

export const deleteCamera = state => {
    let deleteCameraId    = state.deletemodule.cameraId
    let deleteCamera      = state.global.cameras.find(e => e.id == deleteCameraId)
    return deleteCamera
}

export const getEditCamera = state => {
    let editCameraId    = state.editmodule.cameraId
    let editCamera      = state.global.cameras.find(e => e.id == editCameraId)
    return editCamera
}

export const getViewCamera = state => {
    let viewCameraId    = state.viewmodule.cameraId
    let viewCamera      = state.global.cameras.find(e => e.id == viewCameraId)
    return viewCamera
}