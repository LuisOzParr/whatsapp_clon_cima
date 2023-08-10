import {useGET, usePOST} from "src/hooks/useApi";

const url = 'v1/chats'

export const useIndexChat = () => useGET({  url });

export const useStoreChat = (chatId) => usePOST({ url: `${url}/${chatId}` });
