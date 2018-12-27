<template>
  <section id="textEdit">
    <div class="container">
      <!-- tags -->
      <div class="title__wrapper" style="margin-bottom:10px;">
        <div class="tags__wrapper">
          <div class="ui-tag__wrapper"><div @click="text = all; type = 'all'" :class="{ active: type === 'all' }" class="ui-tag"><span class="tag-title">All</span></div></div>
          <div class="ui-tag__wrapper"><div @click="text = seo; type = 'seo'" :class="{ active: type === 'seo' }" class="ui-tag"><span class="tag-title">SEO</span></div></div>
          <div class="ui-tag__wrapper"><div @click="text = headline; type = 'headline'" :class="{ active: type === 'headline' }" class="ui-tag"><span class="tag-title">Headline</span></div></div>
          <div class="ui-tag__wrapper"><div @click="text = textonly; type = 'textonly'" :class="{ active: type === 'textonly' }" class="ui-tag"><span class="tag-title">Text</span></div></div>
          <div class="ui-tag__wrapper"><div @click="text = button; type = 'button'" :class="{ active: type === 'button' }" class="ui-tag"><span class="tag-title">Button</span></div></div>
        </div>
        <div class="tags__wrapper">
          <div class="ui-tag__wrapper"><div @click="text = contentmain; type = 'contentmain'" :class="{ active: type === 'contentmain' }" class="ui-tag"><span class="tag-title">Main</span></div></div>
          <div class="ui-tag__wrapper"><div @click="text = content; type = 'content'" :class="{ active: type === 'content' }" class="ui-tag"><span class="tag-title">Content</span></div></div>
        </div>
      </div>
      <!-- Search input -->
      <Search placeholder="Text fragment" :value="search" @search="search = $event"></Search>

      <!-- INFO WCMS -->
      <!-- seo -->
      <transition name="slide-fade">
        <div v-if="type === 'seo' && showInfoSeo === true" class="ui-alert ui-alert--primary"><span class="alert-title">
          SEO Settings. <br> Like &lt;title&gt;&lt;/title&gt; or &lt;description&gt;&lt;/description&gt; ...
        </span><span @click="showInfoSeo = false" class="button-close"></span></div>
      </transition>
      <!-- main -->
      <transition name="slide-fade">
        <div v-if="type === 'contentmain' && showInfoMain === true" class="ui-alert ui-alert--primary"><span class="alert-title">
          Beta <br>
          Only &lt;p&gt; and &lt;span&gt; with class wcms-text. <br> Example: &lt;span class=&quot;wcms-text&quot;&gt;Example text&lt;/span&gt;
        </span><span @click="showInfoMain = false" class="button-close"></span></div>
      </transition>
      <!-- content -->
      <transition name="slide-fade">
        <div v-if="type === 'content' && showInfoContent === true" class="ui-alert ui-alert--primary"><span class="alert-title">
          Beta <br>
          Only &lt;div&gt; with class wcms-text. <br> Example: &lt;div class=&quot;wcms-textarea&quot;&gt;Example text&lt;/div&gt;
        </span><span @click="showInfoContent = false" class="button-close"></span></div>
      </transition>

      <!-- Table  -->
      <table class="ui-table ui-table--hover">
        <thead>
          <tr>
            <th><span>ID</span></th>
            <th><span>Type</span></th>
            <th><span>Field</span></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="text in textFilter"
            :key="text.id">
            <td><span class="ui-text-regular"> {{ text.id }} </span></td>
            <td><span class="ui-text-regular"> {{ text.type }} </span></td>
            <td class="center" @click="editModal(text.id, text.title)" >
              <svg  xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg>
              <span class="ui-text-regular"> {{ text.title }} </span>
            </td>
          </tr>
        </tbody>
      </table>
      <Modal
        v-if="showModal"
        @close="showModal = false"
        :id="textId"
        :title="textTitle"
        :type="type"
        >
      </Modal>
    </div>
  </section>
</template>

<script>
import htmlD from 'locutus/php/strings/html_entity_decode'
import Search from './UI/Search.vue'
import Modal from './TextModal.vue'
export default {
  components: {
    Modal,
    Search
  },
  props: {
    all: {
      type: Array,
      required: true
    },
    seo: {
      type: Array,
      required: true
    },
    headline: {
      type: Array,
      required: true
    },
    textonly: {
      type: Array,
      required: true
    },
    button: {
      type: Array,
      required: true
    },
    contentmain: {
      type: Array,
      required: true
    },
    content: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      search: '',
      showModal: false,
      showInfoMain: true,
      showInfoContent: true,
      showInfoSeo: true,
      text: this.all,
      type: 'all',
      textId: null,
      textTitle: null
    }
  },
  computed: {
    textFilter () {
      let textArray = this.text,
          search    = this.search
      // Not dirty
      if (!search) return textArray
      // Small
      search = search.trim().toLowerCase();
      // Filter
      textArray = textArray.filter(function(item){
        if (item.title.toLowerCase().indexOf(search) !== -1) {
          return item;
        }
      })
      // Filter Array
      return textArray;
    }
  },
  methods: {
    editModal (id, title) {
      this.textId = id
      this.textTitle = title
      this.showModal = !this.showModal
    }
  }
}
</script>

<style scoped>
.ui-alert {
  padding: 14px 30px;
  margin: 30px 0;
}
</style>

