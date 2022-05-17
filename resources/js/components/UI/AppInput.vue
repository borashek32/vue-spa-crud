<template>
  <div>
    <input
      type="text"
      class="app-input"
      placeholder="Enter your title"
      :value="modelValue"
      @input="updateInput"
      >
  </div>
</template>

<script>
export default {
  name: 'app-input',
  props: {
    modelValue: [String, Number]
  },
  methods: {
    updateInput(event) {
      this.$emit('update:modelValue', event.target.value)
    }
  }
}
</script>

<style lang="sass" scoped>
.app-input
  width: 100%
  border: 1px solid teal
  padding: 10px 10px
  margin-bottom: 4px
</style>
