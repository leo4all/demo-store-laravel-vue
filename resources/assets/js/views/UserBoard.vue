<template>
	<div class="card">
      <header class="card-header">
        <i class="fa fa-users"></i>
        <strong>Products</strong>
      </header>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-responsive table-striped table table-responsive w-100 d-block d-md-table" width="100%">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Department</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
           <tbody>
                <tr v-for="(product,index) in products" @key="index" @dblclick="editingItem = product" title="Double click to edit">
                    <td v-html="product.name"></td>
                    <td v-model="product.amount">$ {{product.amount}}</td>
                    <td v-model="product.department">{{product.department}}</td>
                    <td v-model="product.status">
                      <span class="badge badge-status" :class="[product.status=='have enough'?' badge-success':'badge-danger']">{{product.status}}</span>
                    </td>
                    <td>
                      <router-link :to="{ path: '/products/'+product.id}" class="btn btn-sm"><i class="icon-eye"></i></router-link>
                    </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
       <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
    </div>
</template>
<script>
import Modal from "../components/ProductModal";

export default {
  data() {
    return {
      user: null,
      products: [],
      editingItem: null
    };
  },
  components: {
    Modal
  },
  beforeMount() {
    this.user = JSON.parse(localStorage.getItem("user"));
    axios.defaults.headers.common["Content-Type"] = "application/json";
    axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("jwt");
  },
  mounted: function mounted() {
    this.fetch();
  },
  methods: {
    fetch(){
      axios.get('/api/products')
      .then(response => {
          this.products = response.data
      })
      .catch(error => {
          console.error(error);
      })
    },
    endEditing(product) {
      this.editingItem = null;
      let index = this.products.indexOf(product);
      axios
        .put(`/api/products/${product.id}`, {
          amount: product.amount,
          status: product.status
        })
        .then(response => {
          this.products[index] = product;
        })
        .catch(response => {});
    }
  }
};
</script>
