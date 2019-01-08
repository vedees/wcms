import loadMore from '../js/loadMore.js'

export default {
  state: {
    // ACTIVE SLIDER
    notify: [],
    notifyOld: []
  },
  mutations: {
    setNotify (state, payload) {
      state.notify = payload
    },
    setNotifyOld (state, payload) {
      state.notifyOld = payload
    },
    loadNotify (state, payload) {
      state.notify = [...state.notify, ...payload];
    }
  },
  actions: {
    setNotify ({commit}, payload) {
      commit('setNotify', payload)
    },
    setNotifyOld ({commit}, payload) {
      commit('setNotifyOld', payload)
    },
    loadNotify ({commit, getters}) {
      let res = getters.notifyOldFilter
      commit('loadNotify', loadMore(res))
    }
  },
  getters: {
    notifyMain (state) {
      return state.notify
    },
    notifyOld (state) {
      return state.notifyOld
    },
    notifyOldFilter (state) {
      return state.notifyOld.filter(item => {
        return item.main === false
      })
    }
  }
}
