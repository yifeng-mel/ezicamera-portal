import Vue from 'vue'
import Vuex from 'vuex'
import * as actions from './actions'
import * as getters from './getters'

import global from './modules/global'
import add from './modules/add'
import deletemodule from './modules/deletemodule'
import editmodule from './modules/editmodule'
import viewmodule from './modules/viewmodule'

Vue.use(Vuex)

const strict = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
	actions,
	getters,
	modules: {
		global,
		add,
		deletemodule,
		editmodule,
		viewmodule
	},
	strict
})
