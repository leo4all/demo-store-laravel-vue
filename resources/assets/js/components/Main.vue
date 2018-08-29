<template>
	<div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="card text-white bg-primary">
              <div class="card-body pb-0">
                <div class="text-value">{{products || 0}}</div>
                <div><a href='/admin/products'>Products </a></div>
              </div>
              <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart1" height="70"></canvas>
              </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
              <div class="card-body pb-0">
                <div class="text-value">{{users.length || 0 }}</div>
                <div><a href='/admin/users'>Users</a></div>
              </div>
              <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart2" height="70"></canvas>
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
      products: [],
      users: []
    };
  },
  mounted() {
    axios
      .get("/api/users")
      .then(response => {
        this.users = response.data;
      })
      .catch(error => {
        console.error(error);
      });

    axios
      .get("/api/products")
      .then(response => {
        this.products = response.data.total;
      })
      .catch(error => {
        console.error(error);
      });
  }
};
</script>
