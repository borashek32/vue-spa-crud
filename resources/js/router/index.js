import { createRouter, createWebHistory } from 'vue-router'

import App from '../components/App'
import PostsList from '../components/posts/PostsList'
import PostForm from '../components/posts/PostForm'

const routes = [
  {
    path: '/posts',
    name: 'posts.list',
    component: PostsList
  }
]

export default createRouter({
  history: createWebHistory(),
  routes
})
