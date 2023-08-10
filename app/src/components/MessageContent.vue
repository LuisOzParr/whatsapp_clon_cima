<template>
  <q-page class="tw-px-[63px] tw-flex tw-flex-col-reverse">
    <MessagesCard
        v-for="message in messages"
        :key="`massage-${message.id}`"
        :message="message.message"
        :is-user="currentUserId === message.user_id"
        :time="message.created_at_formatted"
    />
  </q-page>
</template>

<script setup>
import { ref, watch, defineProps } from 'vue'
import MessagesCard from 'components/MessagesCard.vue'
const props = defineProps(['messages', 'currentUserId'])

</script>
