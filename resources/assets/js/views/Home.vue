<template>
<header class="masthead">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
              <h1 class="mb-5">xStore is an app that will help you beautifully and easily build your online store, or anything else!</h1>
              <router-link :to="{ name: 'login' }" class="btn btn-outline btn-xl js-scroll-trigger">Login</router-link>
            </div>
          </div>
          <div class="col-lg-5 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                    <img src="/images/demo-screen-1.jpg" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
</template>
