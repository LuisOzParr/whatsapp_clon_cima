<template>
  <q-page class="tw-px-[63px]">
    <MessagesCard message="askdnak" is-user/>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'
import MessagesCard from 'components/MessagesCard.vue'

export default {
  name: 'IndexPage',
  components: { MessagesCard },
  props: ['chatId'],
  setup (props){
  },
}
</script>
