import api from "@/core/http/api";
import { CreateLocationRequest, Location, UpdateLocationRequest } from "./location.model";

export async function getLocations(): Promise<Location[]> {
    return await api.get('/locations').then((res: any) => res.data.map((location: any) => new Location(location)));
}

export async function createLocation(data: CreateLocationRequest): Promise<Location> {
    return await api.post('/locations', data).then((res: any) => new Location(res.data));
}

export async function updateLocation(id: string, data: UpdateLocationRequest): Promise<Location> {
    return await api.put(`/locations/${id}`, data).then((res: any) => res.data);
}

export async function deleteLocation(id: string): Promise<void> {
    return await api.delete(`/locations/${id}`);
}