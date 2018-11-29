<template>
  <div class="table__wrapper">
    <div class="table-search__wrapper">
      <div class="search">
        <!-- Icon -->
        <div class="search--icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></div>
      </div>
      <input
        type="text"
        class="search--input"
        placeholder="Search text fragment"
        v-model="search"/>
    </div>
    <table class="ui-table ui-table--hover">
      <thead>
        <tr>
          <th><span>ID</span></th>
          <th><span>Field</span></th>
          <th><span></span></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in textFilter"
          :key="index">
          <td><span class="ui-text-regular"> {{ index }} </span></td>
          <td><span class="ui-text-regular" @click="editPopup(index, item)"> {{ item }} </span></td>
          <td><span class="ui-text-regular" @click="editPopup(index, item)"> Edit </span></td>
        </tr>

      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    text: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      search: '',
      textt: this.text
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
          if(item.toLowerCase().indexOf(search) !== -1){
              return item;
          }
      })
      // Filter Array
      return textArray;
    }
  },
  methods: {
    editPopup (index, item) {
      console.log(index, item)
    }
  }
}
</script>

//TODO Style