<template>
  <div class="preloader"
    :style="{
      width : width + 'px',
      height: height + 'px',
    }"
  >
    <!-- //todo =) -->
    <div class="wBall" id="wBall_1"><div class="wInnerBall"></div></div>
    <div class="wBall" id="wBall_2"><div class="wInnerBall"></div></div>
    <div class="wBall" id="wBall_3"><div class="wInnerBall"></div></div>
    <div class="wBall" id="wBall_4"><div class="wInnerBall"></div></div>
    <div class="wBall" id="wBall_5"><div class="wInnerBall"></div></div>
  </div>
</template>

<script>
export default {
  props: {
    // ? string
    width: {
      type: Number,
      default: 16
    },
    height: {
      type: Number,
      default: 16
    }


  }
}
</script>

<style scoped>
.preloader {
  position: relative;
  display: inline-block;
  margin:auto;
}

.wBall {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  transform: rotate(225deg);
  animation: orbit 3.6325s infinite;
}

.wInnerBall{
  position: absolute;
  width: 5%;
  height: 5%;
  background: #444ce0;
  left:0px;
  top:0px;
  border-radius: 3px;
}

#wBall_1 {
  animation-delay: 0.796s;
}

#wBall_2 {
  animation-delay: 0.153s;
}

#wBall_3 {
  animation-delay: 0.3165s;
}

#wBall_4 {
  animation-delay: 0.4695s;
}

#wBall_5 {
  animation-delay: 0.633s;
}

@keyframes orbit {
  0% {
    opacity: 1;
    z-index:99;
    transform: rotate(180deg);
    animation-timing-function: ease-out;
  }

  7% {
    opacity: 1;
    transform: rotate(300deg);
    animation-timing-function: linear;
    origin:0%;
  }

  30% {
    opacity: 1;
    transform:rotate(410deg);
    animation-timing-function: ease-in-out;
    origin:7%;
  }

  39% {
    opacity: 1;
    transform: rotate(645deg);
    animation-timing-function: linear;
    origin:30%;
  }

  70% {
    opacity: 1;
    transform: rotate(770deg);
    animation-timing-function: ease-out;
    origin:39%;
  }

  75% {
    opacity: 1;
    transform: rotate(900deg);
    animation-timing-function: ease-out;
    origin:70%;
  }

  76% {
  opacity: 0;
    transform:rotate(900deg);
  }

  100% {
  opacity: 0;
    transform: rotate(900deg);
  }
}
</style>
