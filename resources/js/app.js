require('./bootstrap');

import { createApp } from 'vue'
import router from './router'
import App from './components/App'
import includes from './components/includes'
import components from './components/UI'
import posts from './components/posts'

const app = createApp(App)

includes.forEach(include => {
  app.component(include.name, include)
})

components.forEach(component => {
  app.component(component.name, component)
})

posts.forEach(post => {
  app.component(post.name, post)
})

app.use(router).mount('#app')
