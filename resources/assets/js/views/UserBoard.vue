<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">All your orders</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-md-4 product-box" v-for="(product,index) in products" @key="index">
                            <router-link :to="{ path: '/products/'+product.id}">
                                <h5><span v-html="product.name"></span>
                                    <span class="small-text text-muted float-right">$ {{product.amount}}</span>
                                </h5>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      user: null,
      products: []
    };
  },
  beforeMount() {
    this.user = JSON.parse(localStorage.getItem("user"));
    axios.defaults.headers.common["Content-Type"] = "application/json";
    axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("jwt");

    axios
      .get("api/products/")
      .then(response => {
        this.products = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }
};
</script>
