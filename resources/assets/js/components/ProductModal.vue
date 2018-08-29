<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-container">
        <div class="modal-header">
          <slot name="header" v-html="data.name"></slot>
        </div>
        <div class="modal-body">
          <slot name="body">
            <table class="table">
              <tr>
                <th>Name: </th>
                <td><input type="text" v-model="data.name" class="form-control" :disabled="disabled == 0 ? true : false" required ></td>
              </tr>
              <tr>
                <th>Amount: </th>
                <td><input type="number" step="0.01" v-model="data.amount" class="form-control" required></td>
              </tr>
              <tr>
                <th>Department: </th>
                <td><input type="text" v-model="data.department" class="form-control" :disabled="disabled == 0 ? true : false"></td>
              </tr>
              <tr>
                <th>Description</th>
                <td><textarea v-model="data.description" class="form-control" :disabled="disabled == 0 ? true : false"></textarea></td>
              </tr>
              <tr>
                <th>Status: </th>
                <td>
                  <select v-model="data.status" class="form-control" required>
                    <option value="have enough">Have enough</option>
                    <option value="need to restock">Need to restock</option>
                  </select>
                </td>
              </tr>
            </table>
          </slot>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <slot name="footer">
            <button class="modal-default-button btn btn-primary" @click="uploadFile">Save</button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props : ['product'],
    data(){
      return {
        attachment : null,
        disabled:JSON.parse(localStorage.getItem("user")).is_admin
      }
    },
    computed : {
      data : function(){
        if(this.product != null){
          return this.product
        }
        else {
          return {
            name : "",
            amount : "",
            department : "",
            status : "",
            description : "",
          }
        }
      }
    },
    methods : {
      attachFile(event){
        this.attachment = event.target.files[0];
      },
      uploadFile(event){
        if(this.attachment != null){
          var formData = new FormData();
          axios.post("/api/upload-file", formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          })
          .then(response => {
            this.product.image = response.data
            this.$emit('close', this.product)
          })
        }
        else {
          this.$emit('close', this.product)
        }
      }
    }
  }
</script>
