<template>
	<div class="card">
      <header class="card-header">
        <i class="fa fa-users"></i>
        <strong>Products</strong>
        <div class="card-actions">
          <a class="" href="#" @click="newProduct"><small class="text-muted">Add</small></a>
        </div>
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
                    <td v-html="product.name" ></td>
                    <td v-model="product.amount">$ {{product.amount}}</td>
                    <td v-model="product.department">{{product.department}}</td>
                    <td v-model="product.status">
                      <span class="badge badge-status" :class="[product.status=='have enough'?' badge-success':'badge-danger']">{{product.status}}</span>
                    </td>
                    <td>
                      <router-link :to="{ path: '/products/'+product.id}" class="btn btn-sm"><i class="icon-eye"></i></router-link>
                      <a @click.prevent="deleteItem(product)" class="btn btn-sm"><i class="icon-trash text-danger"></i></a>
                    </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
      <modal @close="addProduct"  :product="addingProduct" v-show="addingProduct != null"></modal>
    </div>
</template>
<script>
import Modal from "./ProductModal";

export default {
  data() {
    return {
      products: [],
      editingItem: null,
      addingProduct: null,
    };
  },
  components: {
    Modal
  },
  beforeMount(){
    axios.get('/api/products')
    .then(response => {
        this.products = response.data
    })
    .catch(error => {
        console.error(error);
    })
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
    newProduct() {
      this.addingProduct = {
        name: null,
        amount: null,
        description: null,
        department: null,
        status: null
      };
    },
    endEditing(product) {
      this.editingItem = null;
      let index = this.products.indexOf(product);
      axios
        .put(`/api/products/${product.id}`, {
          name: product.name,
          amount: product.amount,
          description: product.description,
          department: product.department,
          status: product.status
        })
        .then(response => {
          this.products[index] = product;
        })
        .catch(response => {});
    },
    addProduct(product) {
      this.addingProduct = null;
      axios
        .post("/api/products", {
          name: product.name,
          amount: product.amount,
          description: product.description,
          department: product.department,
          status: product.status
        })
        .then(response => {
          this.fetch()
          this.products.push(product);
        })
        .catch(response => {});
    },
    deleteItem: function deleteItem(product) {
        var _this = this;
         if (confirm("Do you really want to delete it?")) {
           axios
            .delete('/api/products/' + product.id)
            .then(function (response) {
              _this.fetch();
            })
            .catch(function (resp) {
              alert("Could not delete product");
            });
         }
    }
  }
};
</script>
