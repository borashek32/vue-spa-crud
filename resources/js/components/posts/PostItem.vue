<template>
  <div class="app-item">
    <div class="app-item__title">
      <strong>{{ post.title }}</strong>
    </div>

    <div class="app-item__content">
      <p>{{ post.description }}</p>
    </div>

    <div class="app-item__btns">
      <app-button>
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
      </app-button>

      <app-button
        @click="deletePost"
        >
        <i class="fa fa-trash" aria-hidden="true"></i>
      </app-button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'post-item',
  props: {
    post: {
      id: '',
      title: '',
      description: ''
    }
  },
  methods: {

  }
}
</script>

<style lang="sass" scoped>
.app-item
  display: flex
  flex-direction: row
  border-top: 1px solid teal

  .app-item__title
    width: 20%
    padding: 5px
    text-align: left

  .app-item__content
    width: 80%
    padding: 5px
    text-align: left

  .app-item__btns
    display: flex
    flex-direction: row
    align-items: center
</style>
