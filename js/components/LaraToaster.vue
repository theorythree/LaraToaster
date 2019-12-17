<template>
  <div></div>
</template>
<script>
  export default {
    props: ['message','type'],
    mounted() {
      this.$buefy.toast.open({
        message: this.message,
        type: this.type,
        duration: 2000,
        queue: true,
      })
    }
  }
</script>
