<template>
  <div class="tw-flex" v-bind:class="isUser ? 'tw-justify-end' : ''">
    <div v-bind:class="isUser ? 'tw-bg-messages-user' : 'tw-bg-messages-contact' "
         class="tw-rounded-lg tw-text-gray-200 tw-rounded-bl-lg tw-rounded-br-lg tw-mb-4 tw-px-4 tw-py-2 tw-w-5/12"
    >
      <div class="tw-flex tw-flex-col">
        {{ message }}
        <p class="tw-text-right tw-text-xs tw-text-grey-dark tw-mt-1">
          {{ time }}
        </p>
      </div>

    </div>

  </div>
</template>

<script setup>
import { defineProps } from 'vue'
const props = defineProps(['message', 'isUser', 'time'])
</script>
