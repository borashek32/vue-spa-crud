<template>
  <div>
    <div>
      <h3>Create Post</h3>
      <form class="mb-2" @submit.prevent>
        <app-validation-errors
          v-if="validationErrors"
          :errors="validationErrors"
          ></app-validation-errors>

        <app-input v-model="post.title"></app-input>

        <app-textarea v-model="post.description"></app-textarea>

        <div class="btn-area">
          <app-button @click="addPost">
            <i class="fa fa-save"></i>
          </app-button>

          <app-button v-if="edit">
            <i class="fa fa-rotate-left"></i>
          </app-button>
        </div>
      </form>

      <h3 class="text-left">Posts List</h3>

      <div
        v-if="loading"
        style="margin-top:10px"
        >
        Loading...
      </div>

      <div class="app-list">
        <div class="app-item">
          <div class="app-item__title">
            <strong>Title</strong>
          </div>

          <div class="app-item__content">
            <strong>Description</strong>
          </div>

          <div class="app-item__btns">
            <strong>Actions</strong>
          </div>
        </div>

        <div
          v-for="post in posts"
          :post="post"
          :key="post.id"
          >
          <div class="app-item">
            <div class="app-item__title">
              <strong>{{ post.title }}</strong>
            </div>

            <div class="app-item__content">
              <p>{{ post.description }}</p>
            </div>

            <div class="app-item__btns">
              <app-button @click="editPost(post)">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </app-button>

              <app-button @click="deletePost(post.id)">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </app-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'posts-list',
  props: ['errors'],
  data() {
    return {
      posts: [],
      loading: true,
      dialogVisible: false,
      post: {
        id: '',
        title: '',
        description: ''
      },
      edit: false,
      validationErrors: ''
    }
  },
  mounted() {
    this.getPosts()
  },
  methods: {
    getPosts() {
      setTimeout(() => {
        axios
          .get('/api/posts')
          .then(response => {
            this.posts = response.data.data,
            this.loading = false
          })
          .catch(error => {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: "Posts can't be loaded"
            })
        })
      }, 1000);
    },
    deletePost(id) {
      axios
        .delete(`/api/posts/${id}`)
        .then(response =>
          this.getPosts(),
          Swal.fire('Post deleted successfully')
        )
        .catch(error => {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "Post can't be found"
          })
        })
    },
    addPost() {
      if (this.edit === false) {
        axios
          .post(`/api/posts`, {
            title: this.post.title,
            description: this.post.description
          })
          .then(response => {
            if (response.status == 200) {
              this.post.title = ''
              this.post.description = ''
              this.validationErrors = ''
              Swal.fire(response.data.message)
              this.getPosts()
            }
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.validationErrors = error.response.data.errors
            }
            if (error.response.status === 500) {
              this.validationErrors = response.data.message
            }
            console.log(error)
          }
        )
      } else {
        axios
          .put(`/api/posts/${this.post.id}`, {
            title: this.post.title,
            description: this.post.description
          })
          .then(response => {
            if (response.status === 200) {
              this.post.title = ''
              this.post.description = ''
              this.validationErrors = ''
              this.edit = false
              this.getPosts()
              Swal.fire(response.data.message)
            }
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.validationErrors = error.response.data.errors
            }
        })
      }
    },
    editPost(post) {
      this.edit = true
      this.post.id = post.id
      this.post.title = post.title
      this.post.description = post.description
    }
  }
}
</script>

<style lang="sass" scoped>
// .app-item
//   display: flex
//   flex-direction: row
//   border-top: 1px solid teal

//   .app-item__title
//     width: 20%
//     padding: 5px
//     text-align: center
//     color: teal

//   .app-item__content
//     width: 80%
//     padding: 5px
//     text-align: center
//     color: teal

//   .app-item__btns
//     display: flex
//     padding: 5px
//     flex-direction: row
//     align-align: center
//     color: teal

.app-list
  display: flex
  flex-direction: column
  margin-top: 20px

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

form
  display: flex
  flex-direction: column

.btn-area
  display: flex
  flex-direction: row
  justify-content: flex-end
</style>
