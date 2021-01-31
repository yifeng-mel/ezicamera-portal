<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <button class='btn btn-success w-100' data-toggle="modal" data-target="#addFormModal">Add Camera</button>
            </div>       
            <div class="form-group col-md-10">
                <input class="form-control" type="text" v-model="searchStr" placeholder="Search Table"
                   @keyup="search">
            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
                <tr v-for="camera in cameras" :key="camera.id">
                    <td>{{camera.serial_number}}</td>
                    <td>{{camera.board_name}}</td>
                    <td>{{camera.color}}</td>
                    <td>{{camera.price}}</td>
                    <td>{{camera.url}}</td>
                    <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="#" @click="setViewCameraId(camera.id)" data-toggle="modal" data-target="#viewCameraModal">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a>
                          <a class="btn btn-info btn-sm" href="#" @click="setEditCameraId(camera.id)" data-toggle="modal" data-target="#editFormModal">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="#" @click="setDeleteCameraId(camera.id)" data-toggle="modal" data-target="#deleteCameraModal">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>     
                </tr>
            </tbody>
        </datatable>
        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item" v-if="pageNum != prevPageNumber">
                        <a class="page-link" href="#" tabindex="-1" @click="getPrevious()">Previous</a>
                    </li>
                    <li class="page-item disabled" v-else>
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item disabled"><a class="page-link" href="#">  {{currentPageFrom}} - {{currentpageTo}} of {{totalCount}}</a></li>
                    <li class="page-item" v-if="pageNum != nextPageNum">
                        <a class="page-link" href="#" tabindex="-1" @click="getNext()">Next</a>
                    </li>
                    <li class="page-item disabled" v-else>
                        <a class="page-link" href="#" tabindex="-1">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>    
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";
import Datatable from "./Datatable"
import _ from "lodash";

export default {
    name: 'CamerasTable',
    props: [''],
    components: {
        datatable: Datatable
    },
    data() {
        let sortOrders = {};
        let columns = [
            {width: '16%', label: 'Serial Number', name: 'serial_number' },
            {width: '16%', label: 'Board Name', name: 'board_name' },
            {width: '16%', label: 'Color', name: 'color' },
            {width: '16%', label: 'Price', name: 'price' },
            {width: '16%', label: 'URL', name: 'url' },
            {width: '20%'}
        ];
        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            searchStr: '',
            columns: columns,
            sortKey: 'serial_number',
            sortBy: 'serial_number',
            sortOrders: sortOrders,
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },
        }
    },
    computed: {
        ...mapState({
			cameras: state => state.global.cameras,
            pageNum: state => state.global.pageNum,
            totalCount: state => state.global.totalCount
		}),
        ...mapGetters({
            nextPageNum: 'nextPageNum',
            prevPageNumber: 'prevPageNumber',
            currentPageFrom: 'currentPageFrom',
            currentpageTo: 'currentpageTo'
        })
    },
    methods: {
		...mapActions(["getCameras", 'setSearch', 'setPageNum', 'setDeleteCameraId', 'setEditCameraId', 'setViewCameraId']),
        search: _.debounce(function(){
            this.setPageNum(1)
            this.setSearch(this.searchStr)
            this.getCameras()
        }, 500),
        getPrevious: _.debounce(function(){
            this.setPageNum(this.prevPageNumber)
            this.getCameras()
        }, 500),
        getNext: _.debounce(function(){
            this.setPageNum(this.nextPageNum)
            this.getCameras()
        }, 500),
        getDevicesUrl(cameraId){
            return '/admin/camera-devices?camera_id=' + cameraId
        },
	},
}
</script>
<style>    
</style>
