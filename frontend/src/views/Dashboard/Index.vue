<template>
  <div class="digital-clock">
    {{ currentTime }}
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentTime: ""
    };
  },
  mounted() {
    setInterval(() => {
      const date = new Date();
      const hours = date.getHours().toString().padStart(2, "0");
      const minutes = date.getMinutes().toString().padStart(2, "0");
      const seconds = date.getSeconds().toString().padStart(2, "0");
      this.currentTime = `${hours}:${minutes}:${seconds}`;
    }, 1000);
  }
};
</script>

<style>
.digital-clock {
  font-size: 2rem;
  font-weight: bold;
  text-align: center;
}
</style>