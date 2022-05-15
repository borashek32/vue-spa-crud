<template>
  <div
    v-if="validationErrors"
    class="alert alert-danger"
    >
    <ul>
      <p
        v-for="(value, index) in validationErrors"
        :key="index"
        >
        {{ value }}
      </p>
    </ul>
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
