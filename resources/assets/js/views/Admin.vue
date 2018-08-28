<template>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item"><a class="nav-link" @click="setComponent('main')"> <i class="icon-home"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" @click="setComponent('products')"><i class="icon-handbag"></i> Products</a></li>
            <li class="nav-item"><a class="nav-link" @click="setComponent('users')"><i class="icon-user"></i>Users</a></li>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
        </ol>
        <div class="container-fluid">
          <div class="wrapper">
            <div class="animated fadeIn">
              <div class="row">
                <div class="col-md-12">
                  <component :is="activeComponent"></component>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
</template>
<script>
import Main from "../components/Main";
import Users from "../components/Users";
import Products from "../components/Products";

export default {
  data() {
    return {
      user: null,
      activeComponent: null
    };
  },
  components: {
    Main,
    Users,
    Products
  },
  beforeMount() {
    this.setComponent(this.$route.params.page);
    this.user = JSON.parse(localStorage.getItem("user"));
    axios.defaults.headers.common["Content-Type"] = "application/json";
    axios.defaults.headers.common["Authorization"] =
      "Bearer " + localStorage.getItem("jwt");
  },
  methods: {
    setComponent(value) {
      switch (value) {
        case "users":
          this.activeComponent = Users;
          this.$router.push({ name: "admin-pages", params: { page: "users" } });
          break;
        case "products":
          this.activeComponent = Products;
          this.$router.push({
            name: "admin-pages",
            params: { page: "products" }
          });
          break;
        default:
          this.activeComponent = Main;
          this.$router.push({ name: "admin" });
          break;
      }
    }
  }
};
</script>
