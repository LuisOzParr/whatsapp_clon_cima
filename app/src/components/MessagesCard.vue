<template>
  <div class="tw-flex" v-bind:class="isUser ? 'tw-justify-end' : ''">
    <div v-bind:class="isUser ? 'tw-bg-messages-user' : 'tw-bg-messages-contact' "
         class="tw-relative tw-rounded-lg tw-text-gray-200 tw-rounded-bl-lg tw-rounded-br-lg tw-mb-4 tw-px-4 tw-py-2 tw-w-5/12"
    >
      <q-btn-dropdown class="without-icon tw-absolute tw-top-0 tw-right-2" flat dense icon="expand_more">
        <q-list>
          <q-item clickable v-close-popup @click="() => onClickResend(id)">
            <q-item-section>
              <q-item-label>Reenviar</q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
      </q-btn-dropdown>
      <div class="tw-flex tw-flex-col">
        <p class="tw-whitespace-normal tw-break-words">
          {{ message }}
        </p>
        <div class=" tw-flex tw-gap-2 tw-justify-end tw-items-center">
          <p class="tw-text-right tw-text-xs tw-text-grey-dark tw-mt-1 ">
            {{ time }}
          </p>
          <q-icon
            size="xs"
            :name="icon"
          />
        </div>
      </div>



    </div>

  </div>
</template>

<script setup>
import { defineProps } from 'vue'
const props = defineProps(['message', 'isUser', 'time', 'icon', 'id', 'onClickResend'])
</script>
