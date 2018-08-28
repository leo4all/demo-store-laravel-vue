<template>
	<div class="card">
      <header class="card-header">
        <i class="fa fa-users"></i>
        <strong>Users</strong>
        <div class="card-actions">
          <a class="" href="#" @click="newUser"><small class="text-muted">Add</small></a>
        </div>
      </header>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-responsive table-striped table table-responsive w-100 d-block d-md-table" width="100%">
              <thead>
                    <tr>
                        <td></td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Joined</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user,index) in users" @key="index">
                        <td>{{index+1}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.created_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
	</div>
</template>
<script>
export default {
  data() {
    return {
      users: []
    };
  },
  beforeMount() {
    axios
      .get("/api/users/")
      .then(response => {
        this.users = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  },
  methods: {
    newUser() {
      this.users = {
        name: null,
        email: null
      };
    },
    addUser(product) {
      this.addingProduct = null;
      axios
        .post("/api/users/", {
          name: users.name,
          name: users.email,
        })
        .then(response => {
          this.users.push(user);
        })
        .catch(response => {});
    }
  }
};
</script>
