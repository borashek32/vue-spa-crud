<template>
  <div class="wrapper">
    <app-navbar title='Vue dashboard' />

    <div class="container main">
      <div class="mt-4 mb-4">
        <div>
          <posts-list
            @create="createPost"
            ></posts-list>
          <!-- <router-view></router-view> -->
        </div>
      </div>
    </div>

    <app-footer />
  </div>
</template>

<script>
export default {
  props: {
    title: String
  },
  methods: {
    createPost(post) {
      console.log(post);
    }
  }
}
</script>

<style lang="sass">
*
  margin: 0
  padding: 0
  box-sizing: border-box

body
  margin: 0
</style>
