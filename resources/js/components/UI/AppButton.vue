<template>
  <a href="#" class="app-button">
    <slot></slot>
  </a>
</template>

<script>
export default {
  name: 'app-button'
}
</script>

<style lang="sass" scoped>
a
  text-decoration: none

.app-button
  width: 30px
  height: 30px
  background: none
  color: teal
  border: 1px solid teal
  cursor: pointer
  margin-left: 5px
  display: flex
  justify-content: center
  align-items: center
</style>
