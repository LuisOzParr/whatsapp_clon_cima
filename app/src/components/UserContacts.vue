<template>
  <q-item clickable v-ripple>
    <q-item-section avatar>
      <q-avatar>
        <img src="~assets/default-avatar.jpeg" alt="">
      </q-avatar>
    </q-item-section>

    <q-item-section>
      <q-item-label lines="1">{{ name }} </q-item-label>
<!--      <q-item-label caption lines="1">-->
<!--        &#45;&#45; I'll be in your neighborhood doing errands this-->
<!--      </q-item-label>-->
    </q-item-section>

<!--    <q-item-section side top>-->
<!--      1 min ago-->
<!--    </q-item-section>-->
  </q-item>
</template>

<script>
export default {
  props: {
    name: String,
  }
}
</script>
