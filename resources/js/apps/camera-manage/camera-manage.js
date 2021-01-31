window.Vue = require('vue');

import App from './components/App.vue'
import store from './store'

Vue.config.productionTip = false

new Vue({
    el: '#camera_manage',
    store,
    render: h => h(App)
})