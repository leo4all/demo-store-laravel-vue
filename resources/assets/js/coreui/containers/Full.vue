<template>
  <div class="app">
    <AppHeader/>
    <div class="app-body">
      <Sidebar :nav-items="nav"/>
      <notifications
        class="custom-notifications"
        :style="{ 'margin-top': offset }" />
      <main class="main">
        <breadcrumb :list="list"/>
        <div class="container-fluid">
          <router-view/>
        </div>
      </main>
      <AppAside/>
    </div>
    <AppFooter/>
  </div>
</template>

<script>
import nav from '../_nav'
import { Header as AppHeader, Sidebar, Aside as AppAside, Footer as AppFooter, Breadcrumb } from '../components'

export default {
  name      : 'Full',
  components: {
    AppHeader,
    Sidebar,
    AppAside,
    AppFooter,
    Breadcrumb,
  },
  data () {
    return {
      nav   : nav.items,
      offset: true,
    }
  },
  computed: {
    name () {
      return this.$route.name
    },
    list () {
      return this.$route.matched
    },
  },
  methods: {
    setPosNotify () {
      const top = $(document).scrollTop()
      const offset = top < 55 ? 55 - top : 0

      this.offset = `${offset}px`
    },
  },
  mounted () {
    $(window).on('scroll', this.setPosNotify)
  },
  beforeDestroy () {
    $(window).off('scroll', this.setPosNotify)
  },
}
</script>
