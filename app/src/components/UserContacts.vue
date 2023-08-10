<template>
  <q-item clickable v-ripple>
    <q-item-section avatar>
      <q-avatar>
        <img src="~assets/default-avatar.jpeg" alt="">
      </q-avatar>
    </q-item-section>

    <q-item-section>
      <q-item-label class="tw-text-gray-title" lines="1">{{ title }} </q-item-label>
      <q-item-label class="tw-text-gray-message" lines="1" v-if="subtitle != null" caption>
        {{ subtitle }}
      </q-item-label>
    </q-item-section>

<!--    <q-item-section side top>-->
<!--      1 min ago-->
<!--    </q-item-section>-->
  </q-item>
</template>

<script>
export default {
  props: ['chat', 'title', 'subtitle']
}
</script>
