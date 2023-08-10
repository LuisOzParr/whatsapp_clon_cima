import {useGET, usePOST} from "src/hooks/useApi";

const url = 'v1/contacts'

export const useIndexContact = () => useGET({  url });
