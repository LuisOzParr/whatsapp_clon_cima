<template>
  <q-page class="tw-px-[63px] tw-flex tw-flex-col-reverse">
    <MessagesCard
        v-for="message in messages"
        :key="`massage-${message.id}`"
        :message="message.message"
        :is-user="currentUserId === message.user_id"
        :time="message.created_at_formatted"
        :icon="icons[message.message_status_id]"
        :on-click-resend="onClickResend"
        :id="message.id"
    />
  </q-page>
</template>

<script setup>
import { defineProps } from 'vue'
import MessagesCard from 'components/MessagesCard.vue'
import {messageStatus} from "src/utils/constants/messageStatus";
const props = defineProps(['messages', 'currentUserId', 'onClickResend'])
const icons = messageStatus;
</script>
