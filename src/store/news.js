import loadMore from '../js/loadMore.js'

export default {
  state: {
    // ACTIVE SLIDER
    news: [],
    newsOld: []
  },
  mutations: {
    setNews (state, payload) {
      state.news = payload
    },
    setNewsOld (state, payload) {
      state.newsOld = payload
    },
    loadNews (state, payload) {
      state.news = [...state.news, ...payload];
    }
  },
  actions: {
    setNews ({commit}, payload) {
      commit('setNews', payload)
    },
    setNewsOld ({commit}, payload) {
      commit('setNewsOld', payload)
    },
    loadNews ({commit, getters}) {
      let res = getters.newsOldFilter
      commit('loadNews', loadMore(res))
    }
  },
  getters: {
    newsMain (state) {
      return state.news
    },
    newsOld (state) {
      return state.newsOld
    },
    newsOldFilter (state) {
      return state.newsOld.filter(item => {
        return item.main === false
      })
    }
  }
}
