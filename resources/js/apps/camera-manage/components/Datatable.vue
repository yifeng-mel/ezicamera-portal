<template>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                        :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                        :style="'width:'+column.width+';'+'cursor:pointer;'">
                        {{column.label}}
                    </th>
                </tr>
            </thead>
            <slot></slot>
        </table>
    </div>
</template>

<script>
import { mapActions, mapState, mapGetters } from "vuex";

export default {
    name: 'Datatable',
    props: ['columns', 'sortKey', 'sortOrders'],
    computed: {}
}
</script>
<style>    
</style>
