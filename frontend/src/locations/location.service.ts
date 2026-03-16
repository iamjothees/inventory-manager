import useApi from "@/shared/contexts/api.context";



export function getLocations() {
    const { api } = useApi();
    return api.get('/locations');

}