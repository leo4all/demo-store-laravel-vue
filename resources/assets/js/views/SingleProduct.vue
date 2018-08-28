<template>
   <div class="app flex-row align-items-center mt-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <a @click="$router.go(-1)" href="#"><i class="icon-arrow-left-circle"></i> back</a>
                </div>
                <div class="card-body pt-4 pb-2">
                  <div class="wrapper row">
                    <div class="preview col-md-6">
                      <div class="preview-pic tab-content">
                        <div class="tab-pane active">
                          <img src="http://placehold.it/290x510" alt="">
                        </div>
                      </div>
                    </div>
                    <div class="details col-md-6">

                      <div class="card text-center">
                        <div class="card-header bg-transparent">
                            <i class="icon-list"></i>Name
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{product.name}}</h5>
                        </div>
                      </div>

                     <div class="card text-center">
                        <div class="card-header bg-transparent">
                            <i class="icon-tag"></i>Department
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">{{product.department}}</h5>
                        </div>
                      </div>

                      <div class="card text-center">
                        <div class="card-header bg-transparent">
                            <i class="icon-speech"></i>Description
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{product.description}}</p>
                        </div>
                      </div>


                      <div class="card text-center">
                        <div class="card-header bg-transparent">
                            <i class="icon-wallet"></i>Amount
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">$ {{product.amount}}</h5>
                        </div>
                      </div>


                      <div class="card text-center">
                        <div class="card-header bg-transparent">
                            <i class="icon-flag"></i>Status
                        </div>
                        <div class="card-body">
                            <h5 class="badge badge-status" :class="[product.status=='have enough'?' badge-success':'badge-danger']">{{product.status}}</h5>
                        </div>
                      </div>

                      <div class="card text-center">
                        <div class="card-header bg-transparent">
                            <i class="icon-like"></i>Ratings
                        </div>
                        <div class="card-body">
                          <p>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                          </p>
                        </div>
                      </div>

                    </div>
                  </div>
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
      product: []
    };
  },
  beforeMount() {
    axios
      .get(`/api/products/${this.$route.params.id}`)
      .then(response => {
        this.product = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  }
};
</script>
