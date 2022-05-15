<template>
  <div>
    <textarea
      rows="3"
      type="text"
      class="app-textarea"
      :value="modelValue"
      @input="updateTextarea"
      placeholder="Enter your description"
      >
    </textarea>
  </div>
</template>

<script>
export default {
  name: 'app-textarea',
  props: {
    modelValue: [String, Number]
  },
  methods: {
    updateTextarea(event) {
      this.$emit('update:modelValue', event.target.value)
    }
  }
}
</script>

<style lang="sass" scoped>
.app-textarea
  width: 100%
  border: 1px solid teal
  padding: 10px 10px
  margin-top: 5px
</style>
