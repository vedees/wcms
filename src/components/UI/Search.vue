<template>
  <!-- Search input -->
  <div class="wrapper__search">
    <div class="search">
      <!-- Icon -->
      <div class="search--icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></div>
    </div>
    <input
      type="text"
      :placeholder="placeholder"
      v-model="search"/>
  </div>
</template>
<script>
export default {
  name: 'Search',
  props: {
    value: {
      type: String,
      required: true
    },
    placeholder: {
      type: String,
      default: 'Search'
    }
  },
  data () {
    return { search: this.value }
  },
  watch: {
    search(val) {
      this.$emit('search', val);
      console.log(val)
    }
  }
}
</script>

<style scoped>
svg {
  color: #adaeb0;
}
/* Search */
.wrapper__search {
  position: relative;
  margin-bottom: 20px;
}
.search {
  top: 0px;
  bottom: 0px;
  left: 0px;
  position: absolute;
}
.search--icon {
  height: 100%;
  padding-left: 16px;
  padding-right: 16px;
  align-items: center;
  display: flex;
}
input {
  padding: 16px 16px 16px 56px !important;
  margin-bottom: 0px;
  border-radius: 12px;
  color: #909399;
  font-size: 16px;
  height: unset !important;
}

</style>


