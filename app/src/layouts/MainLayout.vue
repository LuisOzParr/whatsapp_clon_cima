<template>
  <q-layout view="lHh LpR lFf" class="bg-whatsapp-secondary">

    <q-header class="text-white bg-whatsapp-primary" v-if="contactName !== null">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="~assets/default-avatar.jpeg" alt="">
          </q-avatar>
          {{ contactName }}
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer
      class="tw-bg-messages-contact"
      v-model="leftDrawerOpen"
      show-if-above
    >
      <q-scroll-area style="height: calc(100% - 50px); margin-top: 50px;">
        <q-list v-if="!showNewChatTab" bordered separator class="bg-whatsapp-secondary text-white">
          <UserContacts
            v-for="chat in chats"
            :title="chat?.contacts[0]?.name"
            :subtitle="chat?.last_message?.message"
            v-bind:key="`chat-${chat.id}`"
            @click="() => onClickChat(chat)"
          />
        </q-list>
        <q-list v-if="showNewChatTab" bordered separator class="bg-whatsapp-secondary text-white">
          <UserContacts
            v-for="contact in contacts"
            :title="contact.name"
            :subtitle="contact?.last_message?.message"
            v-bind:key="`contact-${contact.id}`"
            @click="() => onClickContact(contact)"
          />
        </q-list>
      </q-scroll-area>

      <q-toolbar v-if="!showNewChatTab" class="bg-whatsapp-primary text-white absolute-top">
        <q-avatar>
          <img src="~assets/default-avatar.jpeg" alt="">
        </q-avatar>
        <q-toolbar-title>
          {{ userName }}
        </q-toolbar-title>
        <q-btn flat round dense icon="chat" @click="showNewChatTab = true"/>
        <q-btn-dropdown class="without-icon" flat rounded dense icon="more_vert" dropdown-icon="more_vert">
          <q-list>
            <q-item clickable v-close-popup @click="onClickNewContact">
              <q-item-section>
                <q-item-label>Nuevo contacto</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
      </q-toolbar>

      <q-toolbar v-if="showNewChatTab" class="bg-whatsapp-primary text-white absolute-top">
        <q-btn flat round dense icon="arrow_back" @click="showNewChatTab = false"/>
        <q-toolbar-title>
          Nuevo chat
        </q-toolbar-title>
      </q-toolbar>
    </q-drawer>

    <q-page-container>
      <MessageContent :messages="messages" :currentUserId="currentUserId" :onClickResend="onClickResend"/>
    </q-page-container>

    <q-footer class="bg-whatsapp-primary" v-if="contactName !== null">
      <q-toolbar>
        <q-form
          @submit="onSendMessage"
          class="tw-flex tw-w-full"
        >
          <q-btn round flat icon="send" class="q-mr-sm text-white" type="submit"/>
          <q-input
            :onfocus="onFocusInputMessage"
            borderless
            dark
            outlined
            dense
            class="tw-w-full"
            bg-color="blue-grey-10"
            v-model="newMessage"
            placeholder="Escribe un mensaje aquí"
            v-on:keyup.enter="onSendMessage"
          />
        </q-form>
      </q-toolbar>

    </q-footer>

    <DialogNewContact
      :isOpen="isOpen"
      :close-modal="closeModal"
      :on-submit="onSubmitNewContact"
    />
    <DialogResendMessage
      :isOpen="isOpenResendModal"
      :close-modal="closeResendModa"
      :contacts="contacts"
      :onResend="onResend"
    />
  </q-layout>
</template>

<script setup>
import {ref, watch} from 'vue'
import {api} from 'boot/axios'
import {useAuthStore} from 'stores/useAuthStore'
import UserContacts from 'components/UserContacts.vue'
import MessageContent from 'components/MessageContent.vue'
import DialogNewContact from 'components/DialogNewContact.vue'
import useModal from 'src/hooks/useModal'
import {useQuasar} from "quasar";
import {useIndexChat} from "src/services/useChatService";
import {useIndexContact} from "src/services/useContactService";
import DialogResendMessage from "components/DialogResendMessage.vue";

//components: { DialogNewContact, MessageContent, UserContacts },
const $q = useQuasar()
const store = useAuthStore();
const userName = store.userNames;
const currentUserId = store.userId;
const leftDrawerOpen = ref(false)
const newMessage = ref('')
const messages = ref([])
const chatId = ref('')
const contactName = ref(null)
const showNewChatTab = ref(false)
const messageIdResent = ref(null);

const { isOpen, openModal, closeModal } = useModal()
const { isOpen: isOpenResendModal, openModal: openResendModal, closeModal: closeResendModa } = useModal()

const {isFetching: isLoadingChats, data: chats, refetch: refetchChats} = useIndexChat();
const {isFetching: isLoadingContacts, data: contacts, refetch: refetchContacts} = useIndexContact();

const onClickChat = async (chat) => {
  contactName.value = chat.contacts[0].name

  // if (chat.id == null) {
  //   let data = await api.post('/v1/chats', {contact_id: contact.id})
  //   chatId.value = data.data.id;
  // } else {
  //   chatId.value =  chat.chat_id;
  // }

  chatId.value = chat.id

  api.get(`/v1/chats/${chatId.value}/messages`).then(res => {
    messages.value = res.data.data;
  });
}

const onSendMessage = () => {
  api.post(`/v1/chats/${chatId.value}/messages`, {message: newMessage.value}).then(res => {
    messages.value.splice(0, 0, res.data)
    window.scrollTo(0, document.body.scrollHeight);
    newMessage.value = null
    refetchChats();
    refetchContacts();
  })
}

const onSubmitNewContact = (data) => {
  api.post('/v1/contacts', data).then(res => {
    refetchContacts()
    onClickContact(res.data)
    closeModal();
    showNewChatTab.value = false;
  }).catch(error => {
    $q.notify({
      color: 'red-5',
      textColor: 'white',
      icon: 'warning',
      message: error.response.data.message
    })
  });
}

const onClickNewContact = () => {
  openModal()
}

const onClickNewChat = () => {
  showNewChatTab.value = !showNewChatTab.value
}

const onClickContact = (contact) => {
  api.post('/v1/chats', {contact_id: contact.id}).then(({data: chat}) => {
    showNewChatTab.value = false;
    onClickChat(chat)
  })
}

const onFocusInputMessage = () => {
  //api.put(`/v1/messages/${e.message.id}`, {message_status_id: 4});
}

const onClickResend = (messageId) => {
  messageIdResent.value = messageId;
  openResendModal();
}

const onResend = (contactId) => {
  api.post('/v1/messages/resend', {message_id: messageIdResent.value, contact_id: contactId}).then(res => {
    refetchChats()
  });

  closeResendModa()
}

watch(chats, async (newChats, oldChats) => {

  newChats?.forEach((chat, index) => {
    Echo.channel(`chat.${chat.id}`)
      .listen('SendMessageEvent', (e) => {
        if (e.message.user_id !== currentUserId && chatId.value === chat.id) {
          messages.value.splice(0, 0, e.message)
        }
      })
  })
  /**/
})

</script>
