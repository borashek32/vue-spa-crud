<template>
  <div
    v-if="validationErrors"
    >
    <p class="errors"
      v-for="(value, index) in validationErrors"
      :key="index"
      >
      {{ value }}
    </p>
  </div>
</template>

<script>
export default {
  name: 'app-validation-errors',
  props: ['errors'],
  computed: {
    validationErrors() {
      let errors = Object.values(this.errors)
      errors = errors.flat()

      return errors
    }
  }
}
</script>

<style lang="sass" scoped>
.errors
  color: red
  margin-top: 2px
</style>
