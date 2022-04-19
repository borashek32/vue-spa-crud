<template>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <form class="mb-4" @submit.prevent="addPost()">

                    <!-- <validation-errors v-if="validationErrors"
                        :errors="validationErrors"></validation-errors> -->

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <input type="text" class="form-control"
                            v-model="post.title" id="title">
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <textarea rows="5" type="text" class="form-control"
                            v-model="post.description" id="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
        <div v-if="errored" class="alert alert-danger" role="alert">
            Posts can't be loaded now. Try later.
        </div>
        <div v-else>
            <div v-if="loading">
                Loading...
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts" :key="post.id">
                        <td>{{ post.id }}</td>
                        <td>{{ post.title }}</td>
                        <td>{{ post.description }}</td>
                        <td>
                            <div class="row">
                                <a href="#" class="btn btn-success"
                                    @click="editPost(post)">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a href="#" class="btn btn-danger ml-1"
                                    @click="deletePost(post.id)">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <ul class="pagination justify-content-center">
                <li :class="{ disabled: !pagination.prev_page_url }"
                    @click.prevent="getPosts(pagination.prev_page_url)"
                    class="page-item">
                    <a class="page-link" href="#">Previous</a>
                </li>

                <li class="page-item disabled">
                    <a class="page-link" href="#">
                    Page {{ pagination.current_page }} from {{ pagination.last_page }}
                    </a>
                </li>

                <li :class="{ disabled: !pagination.next_page_url }"
                    @click.prevent="getPosts(pagination.next_page_url)"
                    class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
            post: {
                id: '',
                title: '',
                body: ''
            },
            pagination: {},
            edit: false,
            loading: true,
            errored: false,
            validationErrors: ''
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        getPosts(page_url) {
            page_url = page_url || `/api/posts`

            axios
                .get(page_url)
                .then(response => {
                    this.posts = response.data.data
                    this.makePagination(response.data)
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Post can't be found"
                    })
                })
                .finally(() => this.loading = false)
        },
        makePagination(response) {
            const pagination = {
                current_page: response.current_page,
                last_page: response.last_page,
                prev_page_url: response.prev_page_url,
                next_page_url: response.next_page_url
            }
            this.pagination = pagination
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
                        this.post.title = ''
                        this.post.description = ''
                        this.getPosts()
                        Swal.fire(response.data.message)
                    })
                    .catch(error => {
                        if (response.status === 422) {
                            console.log(response.status)
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: this.error.message
                            })
                        }
                    })
            } else {
                axios
                    .put(`/api/posts/${this.post.id}`, {
                        title: this.post.title,
                        description: this.post.description
                    })
                    .then(response => {
                        this.post.title = ''
                        this.post.description = ''
                        this.getPosts()
                        Swal.fire('Post updated successfully')
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.validationErrors = error.response.data.errors
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: this.error.message
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Post can't be edited. Post is already deleted"
                            })
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
