<template>
  <div>
    <header class="p-3 bg-dark text-white">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <h4>
              <strong>{{ title }}</strong>
            </h4>
          </a>

          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li>
              <a href="/" class="nav-link px-2 text-secondary">Home</a>
            </li>

            <li>
              <router-link to="/posts" class="nav-link px-2 text-white">Posts</router-link>
            </li>

            <li>
              <a href="#" class="nav-link px-2 text-white">About</a>
            </li>
          </ul>
        </div>
      </div>
    </header>
  </div>
</template>

<script>
export default {
  name: 'app-navbar',
  props: {
    title: String
  }
}
</script>
