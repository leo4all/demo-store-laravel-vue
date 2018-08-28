<template>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <router-link :to="{name: 'home'}" class="navbar-brand js-scroll-trigger">xStore</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav ml-auto">
                        <span v-if="isLoggedIn">
                          <li><router-link :to="{ name: 'userboard' }" class="nav-link" v-if="user_type == 0"> Hi, {{name}}</router-link></li>
                          <li><router-link :to="{ name: 'admin' }" class="nav-link" v-if="user_type == 1"> Hi, {{name}}</router-link></li>
                        </span>
                        <li class="nav-link" v-if="isLoggedIn">
                          <router-link v-if="isLoggedIn" to="/login" v-on:click.native="logout()" replace>Logout</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <router-view @loggedIn="change"></router-view>
    </div>
</template>
<script>
export default {
  data() {
    return {
      name: null,
      user_type: 0,
      isLoggedIn: localStorage.getItem("jwt") != null
    };
  },
  mounted() {
    this.setDefaults();
  },
  methods: {
    setDefaults() {
      if (this.isLoggedIn) {
        let user = JSON.parse(localStorage.getItem("user"));
        this.name = user.name;
        this.user_type = user.is_admin;
      }
    },
    change() {
      this.isLoggedIn = localStorage.getItem("jwt") != null;
      this.setDefaults();
    },
    logout() {
      localStorage.removeItem("jwt");
      localStorage.removeItem("user");
      this.change();
      this.$router.push("/");
    }
  }
};
</script>
