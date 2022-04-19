<template>
    <div>
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
                            <a href="#" class="btn btn-primary mb-2">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
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
            post_id: '',
            pagination: {},
            edit: false,
            loading: true,
            errored: false
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        getPosts(page_url) {
            page_url = page_url || '/api/posts'

            axios
                .get(page_url)
                .then(response => {
                    this.posts = response.data.data
                    this.makePagination(response.data)
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
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
        }
    }
}
</script>
