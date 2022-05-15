<template>
  <div class="row">
    <div class="col-sm-12">
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
            Back
          </app-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'post-form',
  data() {
    return {
      post: {
        title: '',
        description: ''
      },
      edit: false,
      validationErrors: ''
    }
  },
  methods: {
    hideDialog() {
      this.$emit('update:show', false)
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
              this.$emit('create', this.post)
              this.post.title = ''
              this.post.description = ''

              Swal.fire(response.data.message)
            }
          })
          .catch(error => {
            console.log(error.response.data)
            if (response.status === 422) {
              this.validationErrors = response.data.messages
            }
            if (response.status === 500) {
              this.validationErrors = response.data.message
            }
          })
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
    }
  }
}
</script>

<style lang="sass" scoped>
form
  display: flex
  flex-direction: column

.btn-area
  display: flex
  flex-direction: row
  justify-content: flex-end
</style>
