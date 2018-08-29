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
                <tr v-for="(product,index) in products" @key="index" @dblclick="editingItem = product">
                    <td v-html="product.name"></td>
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
            <tfoot>
              <div class="centered">
                <paginate
                :page-count="pageCount"
                :click-handler="fetch"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'">
              </paginate>
              </div>
            </tfoot>
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
      endpoint:"/api/products/?page=",
      pageCount:10
    };
  },
  components: {
    Modal
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch(page = 1) {
         axios.get(this.endpoint + page)
         .then(({data}) => {
             this.products = data.data;
             this.pageCount = data.last_page;
          }).catch(error => {
            console.error(error);
        });
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
              //toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            })
            .catch(function (resp) {
              alert("Could not delete product");
            });
         }
    }
  }
};
</script>
