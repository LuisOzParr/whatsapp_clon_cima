import { ref } from 'vue'

export const useModal = () => {
  const isOpen = ref(false);

  const openModal = () => {
    isOpen.value = true;
    return true;
  }

  const closeModal = () => {
    isOpen.value = false;
  }

  return {
    isOpen,
    openModal,
    closeModal
  }
};

export default useModal
